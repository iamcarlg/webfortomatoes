<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Compte extends CI_Controller {

        public function __construct()
        {
            parent::__construct();
            $this->load->model('db_model');
            $this->load->helper('url_helper');
        }

        public function creer()
        {
            
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('id', 'id', 'required');
            $this->form_validation->set_rules('mdp', 'mdp', 'required');
            
            if ($this->form_validation->run() == FALSE){

                $this->load->view('templates/haut');
                $this->load->view('compte_creer');
                $this->load->view('templates/bas');
            }
            else{

                $this->db_model->set_compte();
                $this->load->view('templates/haut');
                $this->load->view('compte_succes');
                $this->load->view('templates/bas');
            
            }
            
        }

        // Fonction du controlleur de connexion à la session
        public function connecter()
        {
            $this->load->helper('form');
            // $this->load->library('session');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('pseudo', 'pseudo', 'required');
            $this->form_validation->set_rules('mdp', 'mdp', 'required');
            $this->form_validation->set_message('required','Remplissez tous les champs du formulaire !');

            if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('templates/haut');
                $this->load->view('compte_connecter');
                $this->load->view('templates/bas');
            }
            else
            {                
                $username = addslashes($this->input->post('pseudo'));
                $password = $this->input->post('mdp');
                $etat = 1;

                $salt = "123CarlBurundi";
                $mdp_hash = hash('sha256', $salt.$password);

                // Vérification des données entrées dans les champs de saisie pour entrer dans la SESSION
                if($this->db_model->connect_compte($username,$mdp_hash, $etat))
                {    
                        // Récupération des données et comparaison avec les données qui se trouvent dans la base de donnée
                        $statut=$this->db_model->get_compte_statut($username);
                        $session_data = array('username' => $username, 'statut' => $statut, 'etat' => $etat);

                        $this->session->set_userdata($session_data);

                        if(isset($username) && $_SESSION["statut"]== "Invite" && $_SESSION["etat"] == 1){
                            redirect(base_url()."index.php/compte/accueil_invite");

                        }

                        if($_SESSION["statut"]== "Organisateur"){
                            redirect(base_url()."index.php/compte/accueil_admin");
                        
                        }
                }    

                else
                { // Dans le cas où les données entrées dans les champs de saisie ne sont pas corrects
                        $this->load->view('templates/haut');
                        $this->load->view('compte_error');
                        $this->load->view('templates/bas');
                }                    

            }
        }

        // Fonction qui affiche l'accueil des organisateurs
        public function accueil_admin(){

            $username = $this->session->userdata('username');
            $data['admin'] = $this->db_model->visualiser_profil_admin($username);
            $data['url'] = $this->db_model->get_all_url_pseudo($username);

            if (isset($username) && $_SESSION['statut']=="Organisateur"){
                $this->load->view('templates/haut_admin');
                $this->load->view('afficher_accueil_admin', $data);
                $this->load->view('templates/bas_admin');
            }else{
                redirect("compte/connecter");

            }
            
        }

        // Fonction qui affiche l'accueil des invités
        public function accueil_invite(){

            $username = $this->session->userdata('username');
            $etat = $this->session->userdata('etat'); 

            $data['inv'] = $this->db_model->visualiser_profil_invite($username);
            $data['url'] = $this->db_model->get_all_url_pseudo($username);
            if (isset($username) && $_SESSION['statut']=="Invite" && $_SESSION["etat"] == "1"){

                $this->load->view('templates/haut_invite');
                $this->load->view('afficher_accueil_invite', $data);
                $this->load->view('templates/bas_invite');
                
            }else{
                redirect(base_url(). "index.php/compte/connecter/");
                
            }

        }

        // Fonction de déconnexion de la page privée d'un invité ou un administrateur
        public function deconnecter()
        {

            if(!isset($_SESSION['username']) && !isset($_SESSION['statut'])){

                // Si la session n'est pas ouverte, redirection vers la page de connexion
                $this->load->view('templates/haut');
                $this->load->view('compte_connecter');
                $this->load->view('templates/bas');

            }else{

                //Destruction de la session
                session_destroy();

                // libération des variables globales associées à la session
                unset($_SESSION['username']);
                unset($_SESSION['statut']);

                // Si la session n'est pas ouverte, redirection vers la page de connexion
                $this->load->view('templates/haut');
                redirect(base_url()."index.php/compte/connecter");
                $this->load->view('templates/bas');
            }
            
        }

        //Fonction de modification du mot de passe pour un utilisateur connecté
        public function update_password(){
            
            $username = $this->session->userdata('username');
            $data['org'] = $this->db_model->visualiser_profil_invite($username);

            // Vérification de la session de l'organisateur connecté
            if (isset($username) && $_SESSION['statut']=="Organisateur"){

                // Traitement du formulaire de modification de mot de passe
                $this->load->helper('form');
                $this->load->library('form_validation');
                $this->form_validation->set_rules('mdp', 'mdp', 'required');
                $this->form_validation->set_rules('mdp_new', 'mdp_new', 'required|matches[mdp]');
                $this->form_validation->set_message('required','Remplissez tous les champs du formulaire !');               
                $this->form_validation->set_message('matches','les deux champs ne sont pas identiques!');

                // Récupération des saisies du nouveau mot de passe et de l'ancien
                $password = $this->input->post('mdp');
                $data['org'] = $this->db_model->organisateur_info($_SESSION['username']);

                // Vérification des informations entrées dans le formulaire
                if($this->form_validation->run() == FALSE)
                {
                    $this->load->view('templates/haut_admin');
                    $this->load->view('page_modification_mdp_admin', $data);
                    $this->load->view('templates/bas_admin');

                }
                else{

                    $salt = "123CarlBurundi";
                    $mdp_hash = hash('sha256', $salt.$password);

                    $this->db_model->check_password($username,$mdp_hash);
                    $this->load->view('templates/haut_admin');
                    $this->load->view('page_modification_admin_succes');
                    $this->load->view('templates/bas_admin');

                    // Redirection sur la page privée de l'utilisateur connecté dans 3 sec
                    header( "refresh:3; url=https://obiwan2.univ-brest.fr/licence/lic98/v2/CodeIgniter/index.php/compte/accueil_admin" ); 

                }          

            }

            // Modification du mot de passe pour un Invité connecté
            if (isset($_SESSION['username']) && $_SESSION['statut']=="Invite" ){

                $this->load->helper('form');
                $this->load->library('form_validation');
                $this->form_validation->set_rules('mdp', 'mdp', 'required');
                $this->form_validation->set_rules('mdp_new', 'mdp_new', 'required|matches[mdp]');
                $this->form_validation->set_message('required','Remplissez tous les champs du formulaire !');
                $this->form_validation->set_message('matches','les deux champs ne sont pas identiques!');
                
                $password = $this->input->post('mdp');
                $data['inv'] = $this->db_model->invite_info($_SESSION['username']);
                
                if ($this->form_validation->run() == FALSE)
                {
                    $this->load->view('templates/haut_invite');
                    $this->load->view('page_modification_mdp_inv',$data);
                    $this->load->view('templates/bas_invite');
                }
                else
                {
                    $salt = "123CarlBurundi";
                    $mdp_hash = hash('sha256', $salt.$password);
                    $this->db_model->check_password($_SESSION['username'],$mdp_hash);
                    $this->load->view('templates/haut_invite');
                    $this->load->view('page_modification_inv_succes');
                    $this->load->view('templates/bas_invite');

                    // Redirection sur la page privée de l'utilisateur connecté dans 3 sec
                    header( "refresh:3; url=https://obiwan2.univ-brest.fr/licence/lic98/v2/CodeIgniter/index.php/compte/accueil_invite" ); 
                }
            }

               
        }

    }

?>