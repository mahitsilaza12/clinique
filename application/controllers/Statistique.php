<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statistique extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("ModelConsultation" , "Consultation");
        $this->load->model("ModelPatient" , "Patient");
        $this->load->model("ModelDecision" , "Decision");
        $this->load->model("ModelMedicament" , "Medicament");
        $this->load->model("ModelLigneTraitement" , "LigneTraitement");
        $this->load->model("ModelFactureTraitement" , "FactureTraitement");
        if(!($this->session->has_userdata("state")))
        {
            $this->session->set_flashdata("login" , "Vous devez d'abord vous connecter");
            redirect(base_url()."welcome/login");
        }
    }
    public function index()
    {
        $this->load->view("templates/head" , ["titre" => "Statistique"]);
        $this->load->view("stat/index");
        $this->load->view("templates/footer" , ["script" => "ajax/stat.js"]);
    }
    public function consultationPerDay()
    {
        
    }
    public function remise()
    {
        $this->load->model("ModelJoiner" , "Join");

        echo $this->Join->getRemise();
    }
}