<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelWelcome extends CI_Model
{
    protected $table = "user";
/*    public function __construct()
    {
        parent::__construct();
        $this->load->model("race");
    }*/
    public function dateTime()
    {
        echo json_encode(GETDATE());
    }
    public function login($user , $mdp)
    {
        return $this->db->select()
                        ->where("pseudo" , $user)
                        ->where("mdp" , $mdp)
                        ->get($this->table)
                        ->result();
    }
//    public function
}