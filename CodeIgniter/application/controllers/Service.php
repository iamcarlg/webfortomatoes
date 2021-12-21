<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Service extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('db_model');
        $this->load->helper('url_helper');
    }

    public function afficher()
    {

            $data['titre'] = 'Listes des services :';
            $data['ser'] = $this->db_model->get_all_service();

            $this->load->view('templates/haut');
            $this->load->view('service_afficher',$data);
            $this->load->view('templates/bas');

    }

}
 ?>