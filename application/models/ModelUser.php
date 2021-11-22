<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelUser extends CI_Model
{
    protected $table = "user";

    public function liste()
    {
        return $this->db->get($this->table)
                        ->result();
    }
    public function delete($id)
    {
        return $this->db->where("id" , $id)
                        ->delete($this->table) ? true : false;
    }
    public function add($nom , $mdp, $type)
    {
        $this->db->set([
            "pseudo" => $nom,
            "mdp" => $mdp,
            "type" => $type
        ]);
        return $this->db->insert($this->table) ? true : false;
    }
    public function update($id , $data)
    {
        $this->db->set([
            "pseudo" => $data["pseudo"],
            "mdp" => $data["mdp"],
            "type" => $data["type"]
        ]);

        return $this->db->where("id",$id)
                        ->update($this->table) ? true : false;
    }
}

   