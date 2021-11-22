<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelDecision extends CI_Model
{
    protected $table = "decision";
    
    public function getDecision($codeDecision)
    {
        return $this->db->select("decisionDoc")
                    ->where("codeDecision" , $codeDecision)
                    ->get($this->table)
                    ->result_array()[0]["decisionDoc"];
    }
}
