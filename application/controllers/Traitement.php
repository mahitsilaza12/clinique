<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Traitement extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("ModelTraitement" , "Traitement");
        $this->load->model("ModelLigneTraitement" , "LigneTraitement");
        if(!($this->session->has_userdata("state")))
        {   
            $this->session->set_flashdata("login" , "Vous devez d'abord vous connecter");
            redirect(base_url()."welcome/login");
        }
    }

    public function store()
    {
        $data = ["libelleTrait" => $this->input->post("categorie")];

        $this->session->set_flashdata([
            "message" => "Catégorie ajouté avec succès"
            ]);
        if(!$this->Traitement->store($data))
        $this->session->flashdata([
            "message" => "Erreur lors de l'ajout"
            ]);

            redirect("medicament" , "refresh");
    }
    public function liste()
    {
        echo json_encode($this->Traitement->liste());
    }
    public function see_traitement($codeTrait)
    {
        echo json_encode($this->LigneTraitement->see($codeTrait));
    }
}
