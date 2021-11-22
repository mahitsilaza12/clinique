<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelRappel extends CI_Model
{
    protected $table = "rappel";
    protected $ligne_rappel = "ligne_rappel";
    public function __construct()
    {
        parent::__construct();
    }
    public function liste()
    {
        return $this->db->select()
                        ->where("patient.codePatient = rappel.codePatient")
                        ->order_by("codeRappel" , "DESC")
                        ->get("patient , medicament , rappel")
                        ->result();
    }
    public function addRappel($patient , $date , $type , $code)
    {
        $this->db->set([
            "codePatient" => $patient,
            "dateRappel" =>$date,
            "type" => $type, 
            "codeRappeller" =>$code
        ]);

        return $this->db->insert($this->table) ? true : false;
    }
    // public function addLigneRappel($med , $qte)
    // {
    //     $this->db->set([
    //         "codeRappel" => $this->getLast(),
    //         "codeMed" => $med,
    //         "qte" => $qte
    //     ]);

    //     return $this->db->insert($this->ligne_rappel) ? true : false;
    // }
    public function getLast()
    {
        return $this->liste()[0]->codeRappel;
    }

    public function notifier()
    {
        $sql = "SELECT * FROM rappel WHERE DATEDIFF(dateRappel , NOW()) BETWEEN 0 AND 1";

        return $this->db->query($sql)
                        ->result();// ? true : false;
    }
    //
    public function rappelPasse()
    {
        $sql = "SELECT * FROM traitement ,medicament, rappel , vaccin , ligne_vaccin ,patient WHERE vaccin.codeVaccin = rappel.codeRappeller AND patient.codePatient = rappel.codePatient AND vaccin.codeVaccin = ligne_vaccin.codeVaccin AND medicament.codeMed = ligne_vaccin.codemed AND medicament.codeTrait = traitement.codeTrait";
        
        $result =  $this->db->query($sql);

        return $result->result();
    }
    public function rappelTrait()
    {
        $sql = "SELECT * FROM traitement ,medicament, rappel , facture_traitement , ligne_traitement ,patient WHERE rappel.codeRappeller = facture_traitement.numTraitement AND facture_traitement.numTraitement = ligne_traitement.numTraitement AND rappel.codePatient = facture_traitement.codePatient AND traitement.codeTrait = medicament.codeTrait AND medicament.codeMed = ligne_traitement.codeMed AND patient.codePatient = rappel.codePatient";
        
        $result =  $this->db->query($sql);

        return $result->result();
    }
}