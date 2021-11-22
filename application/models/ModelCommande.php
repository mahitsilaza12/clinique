<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelCommande extends CI_Model
{
    protected $commande = "facture_commande";
    protected $ligne_com = "lignecomfrs";
    //public function liste()
    public function update($codeCom , $payee  , $dateFin , $net)
    {

            $this->db->set([
                "payee" => $payee,
                "dateFin" => $dateFin,
                "codeCom" => $codeCom,
                "net" => $net
            ]);

            return ($this->db->insert("payement_frs")) ? true : false;
    }
    public function liste($date1 = "" , $date2 ="")
    {

        $sql = "SELECT * FROM lignecomfrs , fournisseur , facture_commande , medicament WHERE lignecomfrs.numcom = facture_commande.numcom AND FOURNISSEUR.codeFrs = facture_commande.codeFrs AND lignecomfrs.codeMed = medicament.codeMed";
        
        if($date1 != "" && $date2 != "")

        $sql = "SELECT * FROM lignecomfrs , fournisseur , facture_commande , medicament WHERE lignecomfrs.numcom = facture_commande.numcom AND FOURNISSEUR.codeFrs = facture_commande.codeFrs AND lignecomfrs.codeMed = medicament.codeMed AND dateCom between '".$date1."' and '".$date2."'";
        return $this->db->query($sql)
                        ->result();
    }
    public function store($codeFrs)
    {
        $this->db->set([
            "codeFrs" => $codeFrs,
            "dateCom" => date("Y-m-j")
        ]);
        return $this->db->insert($this->commande);
    }
    public function get_last()
    {
        return $this->db->select("numcom")
                        ->order_by("numcom" , "DESC")
                        ->limit(1)
                        ->get($this->commande)
                        ->result()[0]->numcom;
    }
    public function storeLigne($codeMed , $qte)
    {
        $this->load->model("ModelMedicament" , "Medicament");
        $this->db->set([
            "numcom" => $this->get_last(),
            "codeMed" => $codeMed,
            "qte" => $qte
        ]);
        return $this->db->insert($this->ligne_com) && $this->Medicament->Stockage($qte * $this->Medicament->getMedicament($codeMed)[0]->parPresentation , "+" , $codeMed) ? true : false;
    }
    public function getCommande($codeCom)
    {
        return $this->db->where("numcom" , $codeCom)
                ->get($this->commande)
                ->result();
    }
    public function getLigneCommande($codeCom)
    {
        return $this->db->where("numcom" , $codeCom)
                ->get($this->commande)
                ->result();
    }
    public function factureLigne($codeCom)
    {
        return $this->db->select("libelleTrait,unite,presentation ,prixPresentation, facture_commande.numcom as numfact, lignecomfrs.codeMed , libelleMed , (prixPresentation * qte) as somme, qte , dateCom , nomFrs")
                    ->from(" medicament , traitement , lignecomfrs , facture_commande , fournisseur")
                    ->where("medicament.codeMed = lignecomfrs.codeMed and facture_commande.numcom = lignecomfrs.numcom and medicament.codeTrait = traitement.codeTrait and facture_commande.codeFrs = fournisseur.codeFrs")
                    ->where("facture_commande.numcom" , $codeCom)
                    ->get()
                    ->result();
    }




}