<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelLigneTraitement extends CI_Model
{
    protected $table = "ligne_traitement";

    public function __construct()
    {
        parent::__construct();
        $this->load->model("ModelFactureTraitement" , "FactTraitement");
    }
    public function store($codemed , $qte ,$factured = true)
    {
        $factured = ($factured == true) ? 1 : 0;

        $this->db->set([
            "numTraitement" => $this->FactTraitement->getlast(),
            "codeMed" => $codemed,
            "qte" => $qte * 1.00,
            "factured" => $factured
        ]);
        return $this->db->insert($this->table) && $this->Medicament->Stockage($qte , "-" , $codemed) ? true : false;
    }
    public function see($codeTrait)
    {
        return $this->db->select()
                        ->where("medicament.codeMed = ligne_traitement.codeMed")
                        ->where("numTraitement" , $codeTrait)
                        ->get($this->table." , medicament")
                        ->result();
    }
}