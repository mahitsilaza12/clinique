<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelProprietaire extends CI_Model{
    protected $table = "proprietaire";

    public function __construct()
    {
        parent::__construct();
    }

    
    public function count()
    {
        return $this->db->count_all($this->table);
    }
    public function get_proprio()
    {
        return $this->db->select()
                        ->order_by("NomProprio" , "ASC")
                        ->get($this->table)
           
                        ->result();
    }
    public function proprietaire_remise()
    {
        return $this->db->where("status" , "remisé")
                        ->get($this->table)
                        ->result();
    }
    public function get_proprietaire($codeProprio)
    {
        return $this->db->select()
                        ->where("codeProprio" , $codeProprio)
                        ->get($this->table)
                        ->result();
    }
    public function getProprio($codePatient)
    {
        $tables = array($this->table , "patient");
        return $this->db->where("patient.codePatient", $codePatient)
                    ->get($tables)
                    ->result();
    }
    public function delete($codeProprio)
    {
        $tables = array($this->table , "patient");
        return ($this->db->where("codeProprio", $codeProprio)
                    ->delete($tables)) ? true : false;
    }
    public function store($donnee)
    {
        $data = array(
            "nomProprio" => $donnee["nom"],
            "adresseProprio" => $donnee["adresse"],
            "contactProprio" => $donnee["phone"],
            "emailProprio" => $donnee["email"],
            "status" => $donnee["status"],
            "organisation" => $donnee["ong"]
        );
        $this->db->set($data);
        return ($this->db->insert($this->table)) ? true : false;
    }
    public function search($keyword)
    {
        return $this->db->select("codeProprio , nomProprio , contactProprio , emailProprio , adresseProprio")
                        ->like( "nomProprio " , $keyword , "both")
                        ->or_like("contactProprio" , $keyword , "after")
                        ->or_like("emailProprio" , $keyword , "both")
                        ->or_like("adresseProprio" , $keyword , "both")
                        ->or_like("organisation" , $keyword , "both")
                        ->get($this->table)
                        ->result();
    }
    public function update($codeProprio ,Array $data)
    {
        // $this->db->set($data);
        return $this->db->set([
            "nomProprio" => $data['nomProprio'],
            "adresseProprio" => $data['adresseProprio'],
            "emailProprio" => $data['emailProprio'],
            "contactProprio" => $data['contactProprio'],
            "organisation" => $data['organisation'],
            "status" => $data["status"]
        ])
                        ->where('codeProprio' , $codeProprio)
                        ->update($this->table);
    }
}