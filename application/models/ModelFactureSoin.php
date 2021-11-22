<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelFactureSoin extends CI_Model{
    protected $table = "facture_soin";

    public function store($codePatient ,  $traitement = false)
    {
        if($traitement == true)
        {
            $this->load->model("ModelFactureTraitement");
            $this->db->set([
                "codePatient" => $codePatient,
                "dateSoin" => date("Y-m-j"),
                "numTrait" => $this->ModelFactureTraitement->getLast()
            ]);
        }        

        else{

            $this->db->set([
                "codePatient" => $codePatient,
                "dateSoin" => date("Y-m-j"),
        ]);

        }
        return $this->db->insert($this->table) ? true : false;
    }
    public function getLast()
    {
        return $this->db->order_by("numfactureSoin" , "DESC")
                        ->get($this->table)
                        ->result_array()[0]["numfactureSoin"];
    }
    public function get($numFact)
    
    {
        return $this->db->select("codeComCli, payement_client.type, numFact , prix , remise , payee,net, nomProprio")
                        ->from("soin , payement_client ,  ligne_soin , facture_soin , proprietaire , patient")
                        ->where("patient.codePatient = facture_soin.codePatient AND payement_client.numFact = facture_soin.numfactureSoin AND soin.codeSoin = ligne_soin.codeSoin AND ligne_soin.numfactureSoin = facture_soin.numfactureSoin AND patient.codeProprio = proprietaire.codeProprio")
                        ->where("facture_soin.numfactureSoin" , $numFact)
                        ->get()
                        ->result();
    }

    public function factureSoin()
    {

        $sql = "SELECT  DISTINCT codeComCli, payement_client.type, numFact , prix , remise , payee,net, nomProprio FROM soin , payement_client ,  ligne_soin , facture_soin , proprietaire , patient WHERE patient.codePatient = facture_soin.codePatient AND payement_client.numFact = facture_soin.numfactureSoin AND soin.codeSoin = ligne_soin.codeSoin AND ligne_soin.numfactureSoin = facture_soin.numfactureSoin AND patient.codeProprio = proprietaire.codeProprio ORDER BY (net - payee) DESC ";
        return $this->db->query($sql)
                    ->result();
    }
    public function getLaster()
    {
        return $this->db->order_by("numfactureSoin" , "DESC")
                        ->get($this->table)
                        ->result();
    }
}