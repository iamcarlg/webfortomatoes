<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Lieu extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('db_model');
        $this->load->helper('url_helper');
    }

    public function afficher()
    {

            $data['titre'] = 'Listes des lieux :';
            $data['lie'] = $this->db_model->get_all_lieu();

            $this->load->view('templates/haut');
            $this->load->view('lieu_afficher',$data);
            $this->load->view('templates/bas');

    }

}
 ?>