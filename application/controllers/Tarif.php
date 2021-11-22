<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tarif extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if(!($this->session->has_userdata("state")))
        {
            $this->session->set_flashdata("login" , "Vous devez d'abord vous connecter");
            redirect(base_url()."welcome/login");
        }
    }
    public function index()
    {
        $this->load->view("templates/head" , ["titre" => "Tarif"]);
        $this->load->view("tarif/index");
        $this->load->view("templates/footer" , ["script" => "ajax/tarif.js"]);
    }
    public function tarif()
    {
        $this->load->model("ModelSoin");
        $this->load->view("tarif/tarif" , ["soin" => $this->ModelSoin->tarif()]);
    }
}