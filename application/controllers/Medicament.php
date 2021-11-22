<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medicament extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("ModelMedicament" , "Medicament");
        if(!($this->session->has_userdata("state")))
        {
            $this->session->set_flashdata("login" , "Vous devez d'abord vous connecter");
            redirect(base_url()."welcome/login");
        }
    }
    public function datePeremption()
    {
        echo json_encode($this->Medicament->dateperemption());
    }
    public function index()
    {
        
        $this->load->view("templates/head" , ["titre" => "Medicament"]);
        $this->load->view("medicament/index" , ["data" => $this->Medicament->stock() , "peremption" => $this->Medicament->dateperemption()]);
        $this->load->view("templates/footer" , ["script" => "ajax/medicament.js"]);
    }

    public function liste($traitement = "")
    {
        echo json_encode($this->Medicament->showByTraitement($traitement));
    }
    public function listes($traitement = "")
    {
        echo json_encode($this->Medicament->showByLibTraitement($traitement));
    }
    public function stockinsuffisant()
    {
        echo json_encode($this->Medicament->stock());
    }
    public function delete($codeMed)
    {
        echo json_encode($this->Medicament->delete($codeMed));
    }
    public function listeMed()
    {

        $this->load->view("medicament/liste" , ["med" => $this->Medicament->showByTraitement()]);

    }
    public function store()
    {
        $data = array(
            "libelleMed" => $this->input->post("libelle"),
            "unite" => $this->input->post("unite"),
            "description" => $this->input->post("description"),
            "puDetail" =>(int) $this->input->post("pu"),
            "presentation" => $this->input->post("presentation"),
            "parPresentation" => (int)$this->input->post("parPresentation"),
            "presentationGros" => $this->input->post("presentationGros"),
            // @ update vô miasa "datePeremption" => $this->input->post("datePeremption"),
            "codeTrait" => $this->input->post("codeTrait"),
            "prixPresentation" => $this->input->post("prixPresentation")
        );
        echo json_encode($this->Medicament->storeMedicament($data));
    
    }
    public function search($keywords)
    {
        echo json_encode($this->Medicament->search($keywords));
    }
    public function all()
    {
        echo json_encode($this->Medicament->liste());
    }
    public function thisMedicament($codeMed)
    {
        echo json_encode($this->Medicament->getMedicament($codeMed));
    }
    public function update()
    {
        echo json_encode($this->Medicament->update($this->input->post("codeMedEdit"),$this->input->post("puEdit") ,$this->input->post("puPres") , $this->input->post("newLibelle"), $this->input->post("qteEdit"), $this->input->post("newDate")));
    }
    public function see($codeMed)
    {
        $this->load->view("templates/head");
        $this->load->view("medicament/see" , ["medicament" => $this->Medicament->see_med($codeMed)]);
        $this->load->view("templates/footer");
    }
}