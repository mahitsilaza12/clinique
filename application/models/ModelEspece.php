<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelEspece extends CI_Model{
        protected $table= "espece";
        public function __construct()
        {
            parent::__construct();
        }

        public function get_espece($codeEsp)
        {
            return $this->db->select("libelle_espece")
                            ->where("codeEspece" , $codeEsp)
                            ->get($this->table)
                            ->result_array()[0];
        }
        public function addEspece($libelle)
        {
            $this->db->set([
                'libelle_espece' => $libelle
            ]);

            return $this->db->insert($this->table) ? true : false;
        }
        public function liste()
        {
            return $this->db->select()
                            ->where("libelle_espece != 'toutes' ")
                            ->get($this->table)
                            ->result();
        }
}