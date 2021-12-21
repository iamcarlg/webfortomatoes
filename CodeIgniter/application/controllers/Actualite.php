<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Actualite extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('db_model');
        $this->load->helper('url_helper');
    }

    public function afficher()
    {
        // if ($numero==FALSE)
        // { 
        //     $url=base_url(); header("Location:$url");
        // }
        // else{
        //     $data['titre'] = 'Listes des actualités :';
        //     $data['actu'] = $this->db_model->get_actualite();

        //     $this->load->view('templates/haut');
        //     $this->load->view('actualite_afficher',$data);
        //     $this->load->view('templates/bas');
        // }

            $data['titre'] = 'Listes des actualités :';
            $data['actu'] = $this->db_model->get_actualite();

            $this->load->view('templates/haut');
            $this->load->view('actualite_afficher',$data);
            $this->load->view('templates/bas');

    }

}
 ?>