<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelPatient extends CI_Model
{
    protected $table = "patient";

    public function show()
    {
        return $this->db->select()
                        ->order_by("nomPatient")
                        ->where("espece.codeEspece = patient.codeEspece")
                        ->get($this->table.",espece")
                        ->result();
    }
    public function especePatient()
    {
        return $this->db->query("SELECT count(codePatient) as count , libelle_espece from patient, espece where espece.codeEspece = patient.codeEspece group by patient.codeEspece")->result();
    }
    public function store($nom , $dateNaiss = NULL , $age = NULL , $sexe  , $race  , $proprio  , $couleur , $variete , $espece , $descript , $img = "")
    {
        $data = array(
            "nomPatient" => $nom,
            "dateNais" => $dateNaiss ,
            "age" => $age ,
            "codeSexe" => $sexe ,
            "codeRace" => $race ,
            "codeProprio" => $proprio ,
            "variete" => $variete ,
            "couleur" => $couleur,
             "codeEspece" => $espece ,
             "description" => $descript, 
            "img_patient" => $img
            );

        return $this->db->insert($this->table , $data) ? true : false ;
    }
    public function delete($codePatient)
    {
        if($this->isExistPatient($codePatient))
            {
                return $this->db->delete($this->table , ["codePatient" => $codePatient]) ? true : false;
            }
            return false;
    }
    private function isExistPatient($codePatient)
    {
        $patient = $this->db->where("codePatient" , $codePatient)
                            ->get($this->table);

        return $patient->num_rows() > 0 ? true : false;
    }
    public function increment_age()
    {
        $sql = "update  patient SET age = age + 1 where DAY(CURDATE()) = (DATEDIFF(DAY(CURDATE()) , DAY(created_at))) % 30 = 0 ";//AND  = 27";
        return $this->db->query($sql) ? true : false;
    }
    public function statPerYear($year =  "")
    {
        if($year == "")
        return $this->db->select("count(codePatient) , year(created_at) AS year")
                        ->group_by("year")
                        ->get($this->table)
                        ->result();
         return     $this->db->select("count(codePatient) as counter, year(created_at) AS year")
                        ->group_by("year")
                        ->where("year(created_at)" , $year)
                        ->get($this->table)
                        ->result();
    }
    public function search($keyword)
    {
        return $this->db->select("codePatient , nomPatient , age , couleur , variete , description")
                        ->from("patient")
                        ->like( "nomPatient " , $keyword , "both")
                        ->or_like("age" , $keyword , "after")
                        ->or_like("variete" , $keyword , "both")
                        ->or_like("couleur" , $keyword , "both")
                        ->get()
                        ->result();
    }
    public function statPerMonth()
    {
        return $this->db->select("count(codePatient) as count , MONTH(created_at) AS month")
                        ->group_by("month")
                        ->get($this->table)
                        ->result();
    }
    public function statPerDayCons()
    {
        return $this->db->query("SELECT COUNT(codeConsultation) AS COUNT , DAYNAME(dateCons) AS dayname FROM consultation GROUP BY DAYNAME(dateCons)")
                        ->result();
    }
    public function statPerDaySoin()
    {
        return $this->db->query("SELECT COUNT(numfactureSoin) AS COUNT , DAYNAME(dateSoin) AS dayname FROM facture_soin GROUP BY DAYNAME(dateSoin)")
                        ->result();
    }
    public function get_last()
    {
        $where = "patient.codeProprio = proprietaire.codeProprio AND patient.codeEspece = espece.codeEspece AND patient.codeRace = race.codeRace AND patient.codeSexe = sexe.codeSexe";
        
        return $this->db->select("codePatient , patient.codeProprio , nomProprio , NomPatient , age , dateNais , created_at , couleur , variete , description , img_patient , nom_race , nomProprio,  libelle_espece , libelle_sexe ")
                        ->from("patient , proprietaire , sexe , race , espece")
                        ->where($where)
                        ->order_by("codePatient" , "DESC")
                        ->limit(1)
                        ->get()
                        ->result();
    }

    public function get_patient($codePatient)
    {
        $this->load->model("ModelJoiner" , "Join");
        return ($this->isExistPatient($codePatient) == true) ? $this->Join->profil($codePatient) : false;
    }

    public function getNomPatient($codePatient)
    {
        return $this->db->select("nomPatient")
                        ->where("codePatient" , $codePatient)
                        ->get($this->table)
                        ->result();
                        //result_array()[0]["nomPatient"]
    }
    public function getname($codePatient)
    {
        return $this->db->select("nomPatient")
        ->where("codePatient" , $codePatient)
        ->get($this->table)
        ->result_array();
    }

    public function count()
    {
        return $this->db->count_all($this->table);
    }
    
    
    public function himPatient($codeProprio)
    {
        return $this->db->where("codeProprio" , $codeProprio)
                        ->get($this->table)
                        ->result();
    }
    public function getByEspece($codeEspece)
    {
     return $this->db->select()
                        ->where("codeEspece" , $codeEspece)
                        ->order_by("nompatient" , "ASC")
                        ->get($this->table)
                        ->result();   
    }
    public function editer($codePatient , $nom , $codeSexe , $couleur , $date_naiss , $description, $img = ""){
        if( $img != "")
        $data = ([
                "nomPatient" => $nom,
                "description" => $description,
                "dateNais" => $date_naiss,
                "couleur" => $couleur ,
                "img_patient" => $img,
                "codeSexe" => $codeSexe
            ]);
        else
            $data = ([
                "nomPatient" => $nom,
                "description" => $description,
                "dateNais" => $date_naiss,
                "couleur" => $couleur ,
               
                "codeSexe" => $codeSexe
            ]);
        return $this->db->set($data)
            ->where("codePatient" , $codePatient)
            ->update($this->table) ? true : false;
    }
}
