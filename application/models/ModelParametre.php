<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelParametre extends CI_Model{
    protected $table = "parametre";

    public function getParametre($codeparam)
    {
        return $this->db->where("codeParametre" , $codeparam)
                        ->get($this->table)
                        ->result();
    }
    public function getLast()
    {
        return $this->db->select("codeParametre")
                        ->order_by("codeParametre" , "DESC")
                        ->limit(1)
                        ->get($this->table)
                        ->result_array()[0]["codeParametre"];
    }
    public function storeParam($data)
    {
        $donnee = array(
            "freqCard" => $data["freqCard"],
            "freqResp" => $data["freqResp"],
            "TRC" => $data["TRC"],
            "temperature" => $data["temperature"],
            "poids" => $data["poids"],
            "taille" => $data["taille"],
        );

        return $this->db->insert( $this->table , $data) ? true : false;

    }
}