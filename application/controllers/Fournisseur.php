<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 class Fournisseur extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("ModelFournisseur" , "Fournisseur");
        if(!($this->session->has_userdata("state")))
        {
            $this->session->set_flashdata("login" , "Vous devez d'abord vous connecter");
            redirect(base_url()."welcome/login");
        }
    }
    public function count()
    {
        echo $this->Fournisseur->count_all();
    }
    public function search($keywords)
    {
        echo json_encode($this->Fournisseur->search($keywords));
    }
    public function index()
    {
        $this->load->view("templates/head" , ["titre" => "Fournisseur"]);
        $this->load->view("fournisseur/index");
        $this->load->view("templates/footer" , ["script" => "ajax/fournisseur.js"]);
    }

    public function liste()
    {
        echo json_encode($this->Fournisseur->show());
    }
    public function add()
    {
        $data = [
            "nomFrs" => $this->input->post("nomFrs"),
            "responsable" => $this->input->post("responsable"),
            "contact_frs" => $this->input->post("contact_frs"),
            "adresse_frs" => $this->input->post("adresse_frs"),
            "email_frs" => $this->input->post("email_frs")
        ];

        echo json_encode($this->Fournisseur->add($data));
    }
    public function get($codeFrs)
    {
        echo json_encode($this->Fournisseur->get($codeFrs));
    }
    public function update()
    {
        $data = [
            "nomFrs" => $this->input->post("nomFrs"),
            "responsable" => $this->input->post("responsable"),
            "contact_frs" => $this->input->post("contact_frs"),
            "adresse_frs" => $this->input->post("adresse_frs"),
            "email_frs" => $this->input->post("email_frs")
        ];

    echo json_encode($this->Fournisseur->edit($data , $this->input->post("codeFrs")));
    }
    public function download()
    {

            $this->load->view("fournisseur/liste" , ["liste" => $this->Fournisseur->show()]);                

    }
 }