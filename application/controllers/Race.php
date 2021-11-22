<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Race extends CI_Controller{
    protected $title = "Race";

public function __construct()
{
    parent::__construct();
    $this->load->model("ModelRace" , "Race");
        $this->load->model("ModelEspece" , "Espece");
    if(!($this->session->has_userdata("state")))
    {
        $this->session->set_flashdata("login" , "Vous devez d'abord vous connecter");
        redirect(base_url()."welcome/login");
    }
}
   public function index()
    {
    

        $data["chien"] = $this->Race->showCanine();

        $data["chat"] = $this->Race->showChat();

        $data["script"] = "ajax/patient.js";
        $this->load->view("templates/head");

        $this->load->view("patient/race" ,  $data);

        $this->load->view("templates/footer");
    }

    public function getRaceChien()
    {
        echo json_encode($this->Race->showCanine());
    }
    public function getRaceChat()
    {
        echo json_encode($this->Race->showChat());
    }
    public function insert()
    {
        echo json_encode($this->Race->insert($this->input->post("codeEspece") , $this->input->post("nom_race")));
    }
    public function getRace($codeEspece)
    {
        echo json_encode($this->Race->byEspece($codeEspece));
    }
}
