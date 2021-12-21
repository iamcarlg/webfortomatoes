<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Programmation extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('db_model');
        $this->load->helper('url_helper');


    }

    // Fonction d'affichage de la programmations de toutes les animations
    public function afficher()
    {

            $data['titre'] = 'Listes de toutes les animations avec leurs programmation :';
            $data['ani'] = $this->db_model->get_all_programmation();

            $this->load->view('templates/haut');
            $this->load->view('page_programmation',$data);
            $this->load->view('templates/bas');;

    }

    // Fonction d'affichage des détails d'une animation séléctionnée
    public function detail_anim($id){
        $data['titre'] = 'Détails de l\'animation:';
        $data['ani'] = $this->db_model->get_all_animation($id);
        $this->load->view('templates/haut');
        $this->load->view('detail_animation',$data);
        $this->load->view('templates/bas');
    
    }

    // Fonction d'affichage des détails d'un invité séléctionnée
    public function detail_invite($id){
        $data['titre'] = 'Détails de l\'invité:';
        $data['inv'] = $this->db_model->get_all_inv($id);
        $data['url'] = $this->db_model->get_all_inv($id);
        $this->load->view('templates/haut');
        $this->load->view('detail_invite',$data);
        $this->load->view('templates/bas');
    
    }

    // Fonction d'affichage des détails d'un lieu séléctionnée
    public function detail_lieu($id){
        $data['titre'] = 'Détails du lieu:';
        $data['ser'] = $this->db_model->get_all_lieu_id($id);
        // $data['ser'] = $this->db_model->get_all_service_id($id);
        $this->load->view('templates/haut');
        $this->load->view('detail_lieu',$data);
        $this->load->view('templates/bas');
    
    }
 

    public function admin()
    {
        $username = $this->session->userdata('username');
        $data['ani'] = $this->db_model->get_all_programmation();


        if (isset($username) && $_SESSION['statut']=="Organisateur"){

            $this->load->view('templates/haut_admin');
            $this->load->view('page_programmation_admin',$data);
            $this->load->view('templates/bas_admin');

            
        }else{
            redirect(base_url(). "index.php/compte/connecter/");
            
        }

    }

    // Fonction de redirection vers la page de confirmation de la suppression d'une animation séléctionnée
    public function delete($ani_id)
    {
        $username = $this->session->userdata('username');
        $data["ani"] = $ani_id;

        if (isset($username) && $_SESSION['statut']=="Organisateur"){

            $this->load->view('templates/haut_admin');
            $this->load->view('confirmation_suppression', $data);
            $this->load->view('templates/bas_admin');

               
        }else{
            redirect(base_url(). "index.php/compte/connecter/");
            
        }

    }

    // Fonction de confirmation de la suppression de l'animation
    public function confirm_deletion($ani_id){

        $username = $this->session->userdata('username');
        $data["ani"] = $ani_id;

        if (isset($username) && $_SESSION['statut']=="Organisateur"){
            
            $this->db_model->delete_intervention_selected($ani_id);

            $this->load->view('templates/haut_admin');
            $this->load->view('suppression_succes');
            $this->load->view('templates/bas_admin');

            header( "refresh:3; url=https://obiwan2.univ-brest.fr/licence/lic98/v2/CodeIgniter/index.php/programmation/admin" ); 

        }else{
            redirect(base_url(). "index.php/compte/accueil_admin/");
            
        }
    }

        // Fonction de redirection vers la page de confirmation de la suppression d'une animation séléctionnée
        public function update($ani_id)
        {
            $username = $this->session->userdata('username');
            $data["ani"] = $ani_id;
    
            if (isset($username) && $_SESSION['statut']=="Organisateur"){
    
                $this->load->view('templates/haut_admin');
                $this->load->view('confirmation_modification', $data);
                $this->load->view('templates/bas_admin');
    
                $this->confirm_deletion($data['ani']);
    
                   
            }else{
                redirect(base_url(). "index.php/compte/connecter/");
                
            }
    
        }

            // Fonction de confirmation de la suppression de l'animation
    public function confirm_update($ani_id){

        $username = $this->session->userdata('username');
        $data["ani"] = $ani_id;

        if (isset($username) && $_SESSION['statut']=="Organisateur"){
            
            $this->db_model->update_animation_selected($ani_id);

            $this->load->view('templates/haut_admin');
            $this->load->view('page_modification_animation_admin');
            $this->load->view('templates/bas_admin');

        }else{
            redirect(base_url(). "index.php/compte/accueil_admin/");
            
        }
    }
    
}
 ?>