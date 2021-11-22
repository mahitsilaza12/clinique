<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelFournisseur extends Ci_Model{
    protected $table = "fournisseur";

    public function show()
    {
        return $this->db->order_by("nomFrs" ,"ASC")
                    ->get($this->table)
                    ->result();
    }
    public function add($data)
    {
        $this->db->set([
            "nomFrs" => $data["nomFrs"],
            "responsable" => $data["responsable"],
            "contact_frs" => $data["contact_frs"],
            "adresse_frs" => $data["adresse_frs"],
            "email_frs" => $data["email_frs"]
        ]);
        return  $this->db->insert($this->table) ? true : false;
    }
    public function search($keywords)
    {
        return $this->db->select()
                        ->like("nomFrs" ,$keywords)
                        ->or_like("responsable" ,$keywords)
                        ->or_like("contact_frs" ,$keywords)
                        ->or_like("adresse_frs" , $keywords )
                        ->or_like("email_frs" , $keywords)
                        ->get($this->table)
                        ->result();
                        //->

    }
    public function count_all()
    {
        return $this->db->count_all($this->table);
    }
    public function get($codeFrs)
    {
        return $this->db->select()
                        ->where("codeFrs" , $codeFrs)
                        ->get($this->table)
                        ->result();
    }
    public function edit($data , $codeFrs)
    {
        $this->db->set([
            "nomFrs" => $data["nomFrs"],
            "responsable" => $data["responsable"],
            "contact_frs" => $data["contact_frs"],
            "adresse_frs" => $data["adresse_frs"],
            "email_frs" => $data["email_frs"]
        ]);
        $this->db->where("codeFrs" , $codeFrs);
        return  $this->db->update($this->table) ? true : false;
    }
}