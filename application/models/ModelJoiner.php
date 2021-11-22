<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelJoiner extends CI_Model{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model([
            "ModelPatient" => "Patient" ,
            "ModelProprietaire" => "Proprietaire" ,
            "ModelEspece" => "Espece" ,
            "ModelRace" => "Race" ,
            "ModelMedicament" => "Medicament",
            "ModelTraitement" => "Traitement"
        ]);
    }
    public function liste_appro($year1 = "" , $year2 = "")
    {
        $sql = "SELECT DISTINCT codePayement as codeComCli , facture_commande.numcom , net , dateFin,codeCom , libelleMed , unite , qte , presentation , parPresentation , (prixPresentation * qte ) AS prix , payee, nomFrs FROM payement_frs ,medicament ,  lignecomfrs , facture_commande , fournisseur WHERE fournisseur.codeFrs = facture_commande.codeFrs AND payement_frs.codeCom = facture_commande.numcom AND lignecomfrs.numcom = facture_commande.numcom AND medicament.codeMED = lignecomfrs.codeMed ORDER BY (net - payee) DESC ";
        if($year1 != "" && $year2 != "")
        $sql = "SELECT DISTINCT codePayement as codeComCli , facture_commande.numcom , net , dateFin,codeCom , libelleMed , unite , qte , presentation , parPresentation , (prixPresentation * qte ) AS prix , payee, nomFrs FROM payement_frs ,medicament ,  lignecomfrs , facture_commande , fournisseur WHERE fournisseur.codeFrs = facture_commande.codeFrs AND payement_frs.codeCom = facture_commande.numcom AND lignecomfrs.numcom = facture_commande.numcom AND medicament.codeMED = lignecomfrs.codeMed ORDER BY (net - payee) DESC AND facture_commande.dateCom BETWEEN '".$year1."' AND '".$year2."'";
        return $this->db->query($sql)
                        ->result();
    }
    
    public function liste_depense($year1 = "" , $year2 = "")
    {
        $sql = "SELECT DISTINCT *  FROM payement_client , proprietaire WHERE payement_client.codeProprio = proprietaire.codeProprio ORDER BY (net - payee) DESC ";
        if($year1 != "" && $year2 != "")
            $sql = "SELECT DISTINCT *  FROM payement_client , proprietaire WHERE payement_client.codeProprio = proprietaire.codeProprio AND date between '".$year1."' AND '".$year2."' ORDER BY (net - payee) DESC ";

        return $this->db->query($sql)
                        ->result();
    }
    public function liste_depenses($codeProprio)
    {
        $sql = "SELECT DISTINCT codeComCli ,    url , numFact , net , payee , type FROM payement_client WHERE payement_client.codeProprio = ".$codeProprio." ORDER BY (net - payee) DESC ";
        return $this->db->query($sql)
                        ->result();
    }
    public function remiser($remise)
    {
        return $this->db->query("UPDATE remise SET taux = ".$remise) ? true : false;
    }
    public function profil($codePatient)
    {
        return ($codePatient) ? $this->get_patient(null , $codePatient) : false;
    }
    public function get_patient($limit = NULL , $codePatient = false )
    {
        $where = "patient.codeProprio = proprietaire.codeProprio AND patient.codeEspece = espece.codeEspece AND patient.codeRace = race.codeRace AND patient.codeSexe = sexe.codeSexe";
        if($codePatient != false)
        
            $where = $where." and codePatient = ".$codePatient;

        return $this->db->select("img_patient,patient.codeEspece , status , codePatient , patient.codeProprio as codeProprio , nomProprio ,patient.codeSexe as codeSexe,  NomPatient , age , dateNais , created_at , status,couleur , variete , description , img_patient , nom_race , nomProprio,  libelle_espece , libelle_sexe")
                        ->from("patient , proprietaire , sexe , race , espece")
                        ->where($where)
                        ->limit($limit)
                        ->group_by("codePatient")
                        ->get()
                        ->result();
    }
    public function traitementWithMed()
    {
        $traits = $this->Traitement->liste("soin");
        $result = "";
        foreach($traits as $traitement)
        {
            $string = "";
            $input = "";
            $meds = $this->Medicament->showByTraitement($traitement->codeTrait);
            foreach($meds as $med)
            {                
                $string .= "<tr><td style='text-align:center;width:55%'><input type='checkbox' value='".$med->codeMed."' name='codeMed".$med->libelleMed."'> ".$med->libelleMed."</td><td><input style='width:32%;text-align:center' type='text' name='qte".$med->libelleMed."'><span style='color:red'>".$med->unite."</span> [ Stock : ".$med->stock." ".$med->unite."]</td><td><input style='text-align:center' type='checkbox' name='facture_".$med->libelleMed."'>Facturer ce médicament</td></tr>";
            }
            $result .= "<tr><td>".$traitement->libelleTrait."</td><td colspan='2'><div style='height:200px;overflow-y:scroll;'><table style='text-align:center;background-color:rgba(120,250,220,0.4);width:101%;margin : 0 auto' id='med'>".$string."</table></div></td></tr>";
            
        }
        return  $result;
    }

    public function getPayement($codepayement)
    {
        return $this->db->where("codePayement" , $codepayement)
                    ->get("payement_frs")
                    ->result(); 
    }
    public function getPayement_Cli($codepayement)
    {
        return $this->db->where("codeComCli" , $codepayement)
                    ->get("payement_client")
                    ->result(); 
    }
    public function getRemise()
    {
        return $this->db->get("remise")->result()[0]->taux;
    }
}