<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class ModelVaccin extends CI_Model
{
    protected $table = "vaccin";
    protected $table_ligne = "ligne_vaccin";

    public function store($codePatient)
    {
        $this->db->set([
            "codePatient" => $codePatient,
            "dateVaccin" => date("Y-m-j")
        ]);

        return $this->db->insert($this->table) ? true : false;
    }
    public function getLast()
    {
        return $this->db->order_by("codeVaccin" , "DESC")
                        ->get($this->table)
                        ->result()[0]->codeVaccin;
    }
    public function storeLigneVaccin($codeMed , $qte)
    {
        $this->db->set([
            "codeVaccin" => $this->getLast(),
            "codeMed" => $codeMed,
            "qte" => $qte 
        ]);

        return $this->db->insert($this->table_ligne) ? true : false;
    }
}