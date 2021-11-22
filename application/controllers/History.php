<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("ModelConsultation" , "Consultation");
        $this->load->model("ModelCommande" , "Commande");
        if(!($this->session->has_userdata("state")))
        {
            $this->session->set_flashdata("login" , "Vous devez d'abord vous connecter");
            redirect(base_url()."welcome/login");
        }
    }
    public function index()
    {
        $data = $this->Commande->liste();
        if($this->input->post("date1") && $this->input->post("date2"))
            $data = $this->Commande->liste($this->input->post("date1") , $this->input->post("date2"));
        $this->load->view("templates/head" , ["titre" => "Historique"]);
        $this->load->view("history/index" , ["liste" => $data , "listeConsult" => $this->Consultation->consulte() ,  "date1" => $this->input->post("date1") , "date2" => $this->input->post("date2")]);
        $this->load->view("templates/footer" , ["script" => "ajax/history.js"]);
    }
}