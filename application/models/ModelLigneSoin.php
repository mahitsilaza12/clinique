<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelLigneSoin extends CI_Model
{
    protected $table = "ligne_soin";

    public function store($codeSoin)
    {
        $this->load->model("ModelFactureSoin");
        $this->db->set([
            "numfactureSoin" => $this->ModelFactureSoin->getLast(),
            "codeSoin" => $codeSoin
        ]);
        return $this->db->insert($this->table) ? true : false;
    }
    public function facture($numfact)
    {
        return $this->db->select("soin.codeSoin, dateSoin , ligne_soin.numfactureSoin as numfact,proprietaire.codeProprio , adresseProprio , rubrique , prix , nomPatient , nomProprio ")
                        ->where("facture_soin.codePatient = patient.codePatient")
                        ->where("patient.codeProprio = proprietaire.codeProprio")
                        ->where("ligne_soin.codeSoin = soin.codeSoin")
                        ->where("ligne_soin.numfactureSoin = facture_soin.numfactureSoin")
                        ->where("facture_soin.numfactureSoin" , $numfact)
                        ->from("patient , proprietaire , ligne_soin , facture_soin , soin")
                        ->get()
                        ->result();
    }
    public function see($codePatient)
    {
        return $this->db->select("ligne_soin.codeSoin ,dateSoin , ligne_soin.numfactureSoin as numfact , adresseProprio , rubrique , prix , nomPatient , nomProprio ")
                        ->where("facture_soin.codePatient = patient.codePatient")
                        ->where("patient.codeProprio = proprietaire.codeProprio")
                        ->where("ligne_soin.codeSoin = soin.codeSoin")
                        ->where("ligne_soin.numfactureSoin = facture_soin.numfactureSoin")
                        ->where("facture_soin.codePatient" , $codePatient)
                        ->from("patient , proprietaire , ligne_soin , facture_soin , soin")
                        ->get()
                        ->result();
    }
    public function seeWithProprio($codeProprio)
    {
        return $this->db->select("soin.codeSoin as codeSoin ,dateSoin , ligne_soin.numfactureSoin as numfact , adresseProprio , rubrique , prix ,facture_soin.codePatient as codePatient  , nomPatient , nomProprio ")
                        ->where("facture_soin.codePatient = patient.codePatient")
                        ->where("patient.codeProprio = proprietaire.codeProprio")
                        ->where("ligne_soin.codeSoin = soin.codeSoin")
                        ->where("ligne_soin.numfactureSoin = facture_soin.numfactureSoin")
                        ->where("patient.codeProprio" , $codeProprio)
                        ->from("patient , proprietaire , ligne_soin , facture_soin , soin")
                        ->get()
                        ->result();
    }
    public function total($numfact)
    {
        $this->load->model("ModelSoin" , "Soin");
        $this->load->model("ModelFactureSoin");

        //$remise = $this->ModelFactureSoin->getLaster()[0]->remise;

        $donnee = $this->LigneSoin->facture($numfact);
        $total = 0;
        foreach($donnee as $data)
        {
            $total += ($this->Soin->getSoin($data->codeSoin)[0]->prix);
        }


        return  $total;
    }
/*    public function see($codePatient)
    {
        return $this->db->select()
                        ->where("facture_soin.codePatient" , $codePatient)
                        ->where("facture_soin.numfactureSoin = ligne_soin.numfactureSoin AND patient.codePatient = facture_soin.codePatient AND soin.codeSoin = ligne_soin.codeSoin")
                        ->get("facture_soin , patient , soin ,ligne_soin")
                        ->result();

    }*/
}