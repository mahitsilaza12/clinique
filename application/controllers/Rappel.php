<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rappel extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("ModelRappel" , "Rappel");
        if(!($this->session->has_userdata("state")))
        {
            $this->session->set_flashdata("login" , "Vous devez d'abord vous connecter");
            redirect(base_url()."welcome/login");
        }
    }
    public function index()
    {
        $this->load->view("templates/head" , ["titre" => "Rappel"]);
        $this->load->view("rappel/index");
        $this->load->view("templates/footer" , ["script" => "ajax/rappel.js"]);
    }
    public function rappel()
    {
        echo json_encode($this->Rappel->rappelPasse());
    }
    public function rappelTrait()
    {
        echo json_encode($this->Rappel->rappelTrait());
    }
    public function last()
    {
        echo json_encode($this->Rappel->getLast());
    }
    public function notifier()
    {
        echo json_encode($this->Rappel->notifier());
    }
}