<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelFactureTraitement extends CI_Model{
    protected $table = "facture_traitement";

    public function traiter($data)
    {

        $donnee = [
            "dateTraitement" => date("Y-m-j"),
            "codePatient" => $data["codePatient"] ,

        ];
        $this->db->set($donnee);
        return $this->db->insert($this->table) ? true : false;
    }
    public function getlast()
    {
        return $this->db->select("numTraitement")
                        ->order_by("numTraitement" , "DESC")
                        ->get($this->table)
                        ->result()[0]->numTraitement;
    }
    public function factureTrait()
    {
        $sql = "SELECT  DISTINCT codeComCli, payement_client.type, numFact , prix , payee,net, nomProprio FROM traitement , payement_client ,  ligne_traitement , facture_traitement , proprietaire , patient WHERE patient.codePatient = facture_soin.codePatient AND payement_client.numFact = facture_soin.numfactureSoin AND soin.codeSoin = ligne_soin.codeSoin AND ligne_soin.numfactureSoin = facture_soin.numfactureSoin AND patient.codeProprio = proprietaire.codeProprio ORDER BY (net - payee) DESC ";
        return $this->db->query($sql)
                        ->result();
    }
}

//SELECT ligne_traitement.numTraitement , libelleMed ,  nompatient , puDetail, qte , puDetail * qte  AS prix FROM medicament , patient , ligne_traitement , facture_traitement where patient.codePatient = facture_traitement.codePatient and ligne_traitement.numTraitement = facture_traitement.numTraitement AND ligne_traitement.codeMed = medicament.codeMed;