<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Inscription extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('db_model');
        $this->load->helper('url_helper');
    }

    public function afficher()
    {
        $data['titre'] = 'Formulaire d\'inscription';
        $data['cpt'] = $this->db_model->get_actualite();

        $this->load->view('templates/haut');
        $this->load->view('page_inscription',$data);
        $this->load->view('templates/bas');

    }

}
 ?>