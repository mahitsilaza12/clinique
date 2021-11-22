<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parametre extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("ModelParametre" , "Parametre");
    }
    public function showParametre($codePatient)
    {
        echo json_encode($this->Parametre->getParametre($codePatient));
    }
    public function last()
    {
        echo $this->Parametre->getLast();
    }

    public function store()
    {
        if($this->Parametre->storeParam($_POST) == true)
        {
            echo $this->Parametre->getLast();
        }
    }
}