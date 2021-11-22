<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model("ModelUser" , "User");

        if(!($this->session->has_userdata("state")))
    		{
                $this->session->set_flashdata("login" , "Vous devez d'abord vous connecter");
                redirect(base_url()."welcome/login");
            }
    }
    public function index()
    {
        $this->load->view("templates/head" , ["titre" => "Utilisateur"]);
        $this->load->view("user/index" , ["users" =>$this->User->liste()]);
        $this->load->view("templates/footer");
    }
    public function store()
    {
        $user = $this->input->post("nomUser");
        $mdp = $this->input->post("mdp");
        $type = $this->input->post("type");
        
        if($this->User->add($user , $mdp , $type))
        {
            $this->session->set_flashdata("update" , "Un compte a été creé avec succès");
            redirect("user/index");
        }
    }
    public function update($id)
    {
        $data = [
            "pseudo" => $this->input->post("nomUser"),
            "mdp" => $this->input->post("mdp"),
            "type" => $this->input->post("type")
        ];
        if($this->User->update($id , $data))
            {
                $this->session->set_flashdata("update" , "Votre compte a été modifié avec succès");
                redirect("user");
            }
    }
    public function delete($id)
    {
        if($this->User->delete($id))
        {
            $this->session->set_flashdata("update" , "Compte supprimé avec succès");
            redirect("user");
        }
    }

}
