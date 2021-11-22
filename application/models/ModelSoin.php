<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelSoin extends CI_Model
{
    protected $table = "soin";

    public function tarif()
    {
        return $this->db->order_by("prix" , "DESC")
                        ->where("espece.codeEspece = soin.codeEspece")
                        ->get($this->table." , espece")
                        ->result();
    }
    public function getAll($type , $espece)
    {
        if(empty($espece))
        return $this->db->select("rubrique")
                        ->distinct()
                        ->where("espece.codeEspece = soin.codeEspece")
                        ->where("type" , $type)
                        ->get($this->table." , espece")
                        ->result(); 
        else 
            return $this->db->select("rubrique")
                        ->distinct()
                        ->where("soin.codeEspece" , $espece)
                        ->where("type" , $type)
                        ->get($this->table." , espece")
                        ->result();
    }
//Spécialisation pour les tarifs : vaccin , traitement , soin

    
    public function getPriceByName($nomSoin)
    {
        return $this->db->where("rubrique" , $nomSoin)
                        ->get($this->table)
                        ->result_array()[0]["prix"];
    }
    public function getSoinByName($nomSoin)
    {
        return $this->db->where("rubrique" , $nomSoin)
                        ->get($this->table)
                        ->result();
    }
    public function getPriceByNameAndType($nomSoin , $type)
    {
        return $this->db->where("rubrique" , $nomSoin)
                        ->where("type" , $type)
                        ->get($this->table)
                        ->result_array()[0]["prix"];
    }
    public function getSoinByNameAndType($nomSoin)
    {
        return $this->db->where("rubrique" , $nomSoin)
                        ->get($this->table)
                        ->result_array();
    }
    public function getPriceByNameAndEspece($nomSoin , $codeEspece)
    {
        return $this->db->where("rubrique" , $nomSoin)
                        ->where("codeEspece" , $codeEspece)
                        ->get($this->table)
                        ->result_array()[0]["prix"];
    }

    public function getPriceBycode($codeSoin)
    {
        return $this->db->where("codeSoin" , $codeSoin)
                        ->get($this->table)
                        ->result_array()[0]["prix"];
    }
    public function getSoin($codeSoin)
    {
        return $this->db->where("codeSoin" , $codeSoin)
                        ->get($this->table)
                        ->result();
    }
    public function search($keywords)
    {
        $sql = " SELECT * FROM soin , espece WHERE espece.codeEspece = soin.codeEspece AND rubrique LIKE '%".$keywords."%' OR prix LIKE '".$keywords."%' OR description LIKE '%".$keywords."%'";
        return $this->db->query($sql)->result();
    }
    public function insert($rubrique ,$prix, $description , $codeEpsece , $type )
    {
        $this->db->set(["rubrique"=>$rubrique , "prix" => $prix,"description" => $description , "codeEspece" => $codeEpsece , "type" => $type]);

        return $this->db->insert($this->table)? true : false;
    }
    public function delete($codeSoin)
    {
        return $this->db->where("codeSoin" , $codeSoin)
                        ->delete($this->table) ? true : false;
    }
    public function updateSoin( $data ,$codeSoin)
    {
        return $this->db->set([
            "rubrique" => $data['rubrique'],
            "description" => $data['description'],
            "prix" => $data['prix'] ,
            ])
                        ->where("codeSoin" , $codeSoin)
                        ->update($this->table) ? true : false;
    }
    public function updateAll($pourcentage)
    {
        $sql = "UPDATE soin set prix = prix + ((prix * ".$pourcentage.") /100)";

        return $this->db->query($sql) ? true : false ;
    }
    public function getVaccin()
    {
        return $this->db->select("rubrique")
                        ->distinct()
                        ->like("rubrique" , "vaccin" , "both")
                        ->where("espece.codeEspece = soin.codeEspece")
                        ->get($this->table.", espece")
                        ->result();
    }
    public function getSoinByNameAndEspece($nom , $esp)
    {
        return $this->db->where("rubrique" , $nom)
                        ->where("codeEspece" , $esp)
                        ->get($this->table)
                        ->result_array()[0];
    }
    public function getAllByType($type)
    {
        return $this->db->where("type" , $type)
                        ->get($this->table)
                        ->result();
    }

}