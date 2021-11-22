<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelTraitement extends CI_Model{

protected $table = "traitement";

public function liste($without = "")
{
    if($without)
        return $this->db->select()
                    ->where("libelleTrait !=" , $without)
                    ->order_by("libelleTrait" , "ASC")
                    ->get($this->table)
                    ->result();
        return $this->db->select()
                        ->order_by("libelleTrait" , "ASC")                
                        ->get($this->table)
                        ->result();
}

public function store($data)
{
    $array = [
        "libelleTrait" => $data["libelleTrait"]
    ];

return  ($this->db->set($array)
           ->insert($this->table)) ? true : false;
}

 public function delete($codeTraitement)
 {
    $this->db->where("codeTrait" ,  $codeTraitement);
     return ($this->db->delete($this->table)) ? true : false;
 }
 public function update($codeTraitement , $data)
 {
     $array = [
         "libelleTrait" => $data["libelleTrait"]
     ];
     return $this->db->update($this->table , $array , "codeTrait = ".$codeTraitement) ? true : false;
 }
}