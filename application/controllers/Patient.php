<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends CI_Controller{
    private $title = "Patient";
    public function __construct()
    {
        parent::__construct();
        $this->load->model("ModelPatient" , "Patient");
        $this->load->model("ModelJoiner" , "Join");
        if(!($this->session->has_userdata("state")))
        {
            $this->session->set_flashdata("login" , "Vous devez d'abord vous connecter");
            redirect(base_url()."welcome/login");
        }
    }
    public function statPat()
    {
        echo json_encode($this->Patient->especePatient());
    }
    public function index()
    {

        $this->load->view("templates/head" , ["titre" => "Patient"]);

        $this->load->view("patient/index");

        $this->load->view("templates/footer" , ["script" => "ajax/patient.js"]);
       
    }
    public function storePatient()
    {

            $dateNaiss = $this->input->post("dateNaiss");
            $age = $this->input->post("age");
            $nom = $this->input->post("nomPatient");
            $couleur = $this->input->post("couleur");
            $sexe = $this->input->post("sexe");
            $race =  $this->input->post("codeRace");
            $variete = $this->input->post("variete");
            $espece = $this->input->post("espece");
            $proprio = $this->input->post("codeProprio");
            $descrpit = $this->input->post("descript");
            
            $data["file_name"] = "telecharge.jpg";

            if(!empty($_FILES["file_img"]['name']))
            {
                 $file["upload_path"] = "./assets/img";
                
                 $file["allowed_types"] = "png|jpg|jpeg";

                 $this->load->library("upload" , $file);

                 if(!$this->upload->do_upload("file_img"))
                    echo $this->upload->display_errors();

                  $img_name = $this->upload->data();
            
                 $data["file_name"] = $img_name["file_name"];

                    }

        echo json_encode($this->Patient->store($nom , $dateNaiss , $age , $sexe , $race , $proprio , $couleur , $variete , $espece , $descrpit , $data["file_name"]));
            
    }

    public function delete($codePatient)
    {
        if($this->Patient->delete($codePatient))
            echo json_encode("Success");
        else
            echo json_encode("Error");
    }

    public function showCanineList()
    {
        echo json_encode($this->Patient->chien());
    }
    public function showChatList()
    {
        echo json_encode($this->Patient->chat());
    }
    public function liste()
    {
        echo json_encode($this->Patient->show());
    }
    public function profil($codePatient)
    {
        if($this->Patient->get_patient($codePatient))
        {
            $data = $this->Patient->get_patient($codePatient);
            $this->load->view("templates/head" , ["titre" => "Profil" , "second" => $data[0]->NomPatient]);
            $this->load->view("patient/profil" , [
                "data" => $data ,
                "codePatient" => $codePatient 
            ]);
            $this->load->view("templates/footer" , [
                "script" => "ajax/profilPatient.js",
                
            ]);
        }
    }
    public function statPerDaySoin()
    {
        echo json_encode($this->Patient->statPerDaySoin());
    }
    public function statPerDayCons()
    {
        echo json_encode($this->Patient->statPerDayCons());
    }
    
    public function statPerMonth()
    {
        echo json_encode($this->Patient->statPerMonth());
    }

    public function get_last()
    {
        echo json_encode($this->Patient->get_last());
    }
    public function getPatient($codePatient)
    {
        foreach($this->Patient->getNomPatient($codePatient) as $patient)
            echo $patient->nomPatient;
    }
    public function count()
    {
        echo $this->Patient->count();
    }
    public function join($limit = null , $codePatient = false , $order = "nomPatient")
    {
        echo json_encode($this->Join->get_patient($limit , $codePatient , $order));
    }
    public function search($keywords)
    {
        echo json_encode($this->Patient->search($keywords));
    }
    public function incrementDate()
    {
        echo json_encode($this->Patient->increment_age());
    }
    public function statPerYear($an1)
    {
        echo json_encode($this->Patient->statPerYear($an1));
    }
    public function stat()
    {
        echo json_encode($this->Patient->statPerYear());
    }
    public function edit($codePatient)
    {
         $dateNaiss = $this->input->post("dateNaiss");
            $nom = $this->input->post("nomPatient");
            $couleur = $this->input->post("couleur");
            $sexe = $this->input->post("sexe");
          
            $descrpit = $this->input->post("descript");
            $data["file_name"] = "";

            if(!empty($_FILES["file_img"]['name']))
            {
                 $file["upload_path"] = "./assets/img";
                
                 $file["allowed_types"] = "png|jpg|jpeg";

                 $this->load->library("upload" , $file);

                 if(!$this->upload->do_upload("file_img"))
                    echo $this->upload->display_errors();

                  $img_name = $this->upload->data();
            
                 $data["file_name"] = $img_name["file_name"];

                    }

        if($this->Patient->editer($codePatient , $nom , $sexe , $couleur, $dateNaiss , $descrpit , $data["file_name"]))
            $this->profil($codePatient);
    }
}