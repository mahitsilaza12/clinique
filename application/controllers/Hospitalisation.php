<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hospitalisation extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("ModelHospital" , "Hospital");
        if(!($this->session->has_userdata("state")))
        {
            $this->session->set_flashdata("login" , "Vous devez d'abord vous connecter");
            redirect(base_url()."welcome/login");
        }
    }
    public function index()
    {
        $this->load->view("templates/head", ["titre" => "Hospitalisation"]);
    $this->load->view("hopital/index" , ["hospitalise" => $this->Hospital->liste()]);
        $this->load->view("templates/footer" , ["script" => "ajax/hospital"]);
    }
}