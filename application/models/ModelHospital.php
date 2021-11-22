<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelHospital extends CI_Model
{
    protected $table = "hospitalisation";

    public function store($codePatient , $dateDebut , $dateFin)
    {
        $this->db->set([
            "codePatient" => $codePatient,
            "dateDebut" => $dateDebut,
            "dateFin" => $dateFin
            ]);
        return $this->db->insert($this->table) ? true : false;
    }
    public function liste()
    {
      return $this->db->select("nomPatient , dateFin , dateDebut , hospitalisation.codePatient")
                        ->where("hospitalisation.codePatient = patient.codePatient")
                        //->where("datediff(NOW() , dateFin)")
                        ->get($this->table." , patient")
                        ->result();
    }
}