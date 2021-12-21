<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Invite extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('db_model');
        $this->load->helper('url_helper');
    }

    // Affichage de tous les invités selon la fonction get_all_invite dans la page_invite
    public function afficher()
    {

            $data['titre'] = 'Listes de tous les invités :';
            $data['n_inv'] = $this->db_model->nombre_invite_total();
            $data['inv'] = $this->db_model->get_all_invite();
            $data['url'] = $this->db_model->get_all_url();
            $data['pos'] = $this->db_model->get_all_post();

            $this->load->view('templates/haut');
            $this->load->view('page_invite',$data);
            $this->load->view('templates/bas');

    }

        // Affichage de tous les passeports et posts de l'invité connecté
        public function passeport()
        {
            $username = $this->session->userdata('username');

            $data['pas'] = 'Listes de tous les passeports et posts :';
            $data['pas'] = $this->db_model->tous_les_passeports_posts($username);

            if(isset($username) && $_SESSION['statut'] == 'Invite'){

                $this->load->view('templates/haut_invite');
                $this->load->view('page_passeport',$data);
                $this->load->view('templates/bas_invite');
            }else{
                
                // Si la session n'est pas ouverte, redirection vers la page de connexion
                $this->load->view('templates/haut');
                redirect(base_url()."index.php/compte/connecter");
                $this->load->view('templates/bas');
                
            }
    
        }

    public function post(){

            $this->load->helper('form');
            // $this->load->library('session');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('pas_login', 'pas_login', 'required');
            $this->form_validation->set_rules('pas_mdp', 'pas_mdp', 'required');
            $this->form_validation->set_rules('pos_texte', 'pos_texte', 'required|max_length[140]');
            $this->form_validation->set_message('required','Veuillez remplir le formulaire !');
            $this->form_validation->set_message('max_length[140]','Un post a 140 caractères maximum !');
            
            if ($this->form_validation->run() == FALSE)
            {
                
                $this->load->view('templates/haut');
                $this->load->view('passeport_connecter');
                $this->load->view('templates/bas');
                
            }
            else
            {    
                
                $pas_login = $this->input->post('pas_login');
                $pas_mdp = $this->input->post('pas_mdp');   
                $pos_texte = $this->input->post('pos_texte');  
                
                $salt = "123CarlBurundi";
                $mdp_hash = hash('sha256', $salt.$pas_mdp);

                // Including Addlashes

                if($this->db_model->passeport_connect(addslashes($pas_login), addslashes($mdp_hash))){
                    $pas_id_s= $this->db_model->get_pas_id(addslashes($pas_login));
                    $this->db_model->ajout_post($pas_id_s->pas_id, addslashes($pos_texte));
    
                    $this->load->view('templates/haut');
                    $this->load->view('poste_ajoute_msg');
                    $this->load->view('templates/bas');

                    // Redirection vers la galérie des invités après message : Poste ajouté !
                    header( "refresh:3; url=https://obiwan2.univ-brest.fr/licence/lic98/v2/CodeIgniter/index.php/invite/afficher" ); 

                }else{

                    echo "Code(s) erroné(s), aucun passeport trouvé !";

                    header( "refresh:3; url=https://obiwan2.univ-brest.fr/licence/lic98/v2/CodeIgniter/index.php/invite/post" ); 

                    $this->load->view('templates/haut');
                    $this->load->view('passeport_connecter');
                    $this->load->view('templates/bas');
                }

            }
    }

}
 ?>