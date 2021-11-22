<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proprietaire extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("ModelJoiner" , "Join");
        $this->load->model("ModelProprietaire" , "Proprietaire");
        $this->load->model("ModelPatient" , "Patient");
        $this->load->model("ModelConsultation" , "Consultation");
        $this->load->model("ModelLigneSoin" , "LigneSoin");
        if(!($this->session->has_userdata("state")))
        {
            $this->session->set_flashdata("login" , "Vous devez d'abord vous connecter");
            redirect(base_url()."welcome/login");
        }
    }
    public function index()
    {
        $this->load->view("templates/head" , ["titre" => "Propriétaire"]);
        $this->load->view("proprietaire/index");
        $this->load->view("templates/footer" , ["script" => "ajax/proprietaire.js"]);
      }
    public function count()
    {
        echo $this->Proprietaire->count();
    }
    public function get_proprietaire($codeProprio)
    {
        var_dump($this->Proprietaire->get_proprietaire($codeProprio));
    }
    public function show()
    {
        echo json_encode($this->Proprietaire->get_proprio());
    }
    public function remise()
    {
        echo json_encode($this->Proprietaire->proprietaire_remise());
    }
    public function delete($codeProprio)
    {
        $this->Proprietaire->delete($codeProprio);
    }
    public function storeProprio()
    {
        $data = [
            "nom" => $this->input->post("nom"), 
            "adresse" => $this->input->post("adresse"),
            "phone" => $this->input->post("phone"),
            "email" => $this->input->post("email"),
            "status" => $this->input->post("status") ,
            "ong" => $this->input->post("organisation")
        ];
        echo json_encode($this->Proprietaire->store($data));
    }
    public function profil($codeProprio)
    {
        $this->load->view("templates/head" , ["titre" => "Profil" , "second" => $this->Proprietaire->get_proprietaire($codeProprio)[0]->nomProprio]);
        $this->load->view("proprietaire/profil" , ["codeProprio" => $codeProprio ,
         "proprietaire" => $this->Proprietaire->get_proprietaire($codeProprio) ,
         "data" => $this->Join->liste_depenses($codeProprio),
         "soin" => $this->LigneSoin->seeWithProprio($codeProprio),
         "listePatient" => $this->Patient->himPatient($codeProprio),
        ]);
        $this->load->view("templates/footer" , ["script" => "ajax/scriptProprio.js"]);
    }
    public function search($keywords)
    {
        echo json_encode($this->Proprietaire->search($keywords));
    }

    public function export($pdf)
    {
        $result = $this->Proprietaire->get_proprio();
        $result['clients'] = $result;
        if($pdf == "pdf")
        {
            $this->load->library("html2pdf/html2pdf");
            $this->load->view("proprietaire/liste" , $result);
        }
        else
        {
            $this->load->view("proprietaire/excel" , $result);
        }


    }
    public function ca($codeProprio)
    {
        $result = $this->Consultation->chiffreAffaire($codeProprio);
      	$result['ca'] = $result;
		$this->load->library("html2pdf/html2pdf");
        $this->load->view("proprietaire/ca" , $result);
    }
    public function update($codeProprio)
    {
        
        if($this->Proprietaire->update($codeProprio , $_POST))
        {
            $this->session->set_flashdata(["status" => "Mise à jour réussi" , "color" => "success"]);
            redirect("proprietaire/profil/".$codeProprio);
        }
        else
        {
            $this->session->set_flashdata(["status" => "La mise à jour a échoué" , "color" => "warning"]);
            redirect("proprietaire/profil/".$codeProprio);
        }
    }
}
