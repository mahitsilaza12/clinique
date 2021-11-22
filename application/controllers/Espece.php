<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Espece extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("ModelEspece" , "Espece");
    }
    public function add($libelle)
    {
        $this->Espece->addEspece(urldecode($libelle));
    }
    public function getEspece()
    {
        echo json_encode($this->Espece->liste());
    }
}