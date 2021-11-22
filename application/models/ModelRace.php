<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelRace extends CI_Model
{
    protected $table = "race";

    public function showChat()
    {
        return $this->db->select()
                    ->where("codeEspece" , 2)
                    ->get($this->table)
                    ->result();
    }
    public function showCanine()
    {
        return $this->db->select()
                        ->where("codeEspece" , 1)
                        ->get($this->table)
                        ->result();
    }
    public function byEspece($codeEspece)
    {
        return $this->db->select()
                        ->where("codeEspece" , $codeEspece)
                        ->get($this->table)
                        ->result();
    }
    public function store($codeEspece , $nom_race)
    {
        return $this->db->insert($this->table , [
            "nom_race" => $nom-race,
            "codeEspece" => $codeEspece
        ]) ? true : false;
    }
    public function get_race($codeRace)
    {
        return $this->db->select()
                        ->where("codeRace" , $codeRace)
                        ->get($this->table)
                        ->result__array()[0];
    }
    public function insert($codeEspece , $nom)
    {
        $this->db->set([
            "codeEspece" => $codeEspece,
            "nom_race" => $nom
        ]);

        return $this->db->insert($this->table) ? true : false;
    }
}