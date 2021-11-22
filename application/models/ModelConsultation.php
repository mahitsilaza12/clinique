<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelConsultation extends CI_Model
{
    protected $table = "consultation";

    public function __construct()
    {
        parent::__construct();
        $this->load->model("ModelPatient" , "Patient");
        $this->load->model("ModelFactureTraitement" , "FactureTraitement");
/*        $this->load->model("ModelParametre" , "Parametre");
        $this->load->model("ModelDecision" , "Decision");
    */
    }

    public function show()
    {
        return $this->db->select()
                        ->where("numConsult = codeConsultation")
                        ->get($this->table." , facture_traitement")   
                        ->result();
    }

    public function count()
    {
        return $this->db->count_all($this->table);
    }

    public function insertion($donnee)
    {
        $this->load->model("ModelFactureTraitement");
        $this->load->model("ModelFactureSoin");
        $data = array(
            "dateCons   " => date("Y-m-j"),
            "motif" => $donnee["motif"] ,
            "suspicion" => $donnee["suspicion"] ,
            "examComplem" => $donnee["examComplem"] ,
            "anamnese" => $donnee["anamnese"],
            "codeParam" => $donnee["codeParam"] ,
            "codeDecision" => $donnee["codeDecision"] ,
            "codePatient" => $donnee["codePatient"],
            "codeTraitement" => $this->ModelFactureTraitement->getlast(),
            "codeSoin" => $this->ModelFactureSoin->getLast()
        );
        $this->db->set($data);
        return $this->db->insert($this->table) ? true : false;

    }
    public function search($keywords)
    {
        $datas = array();
        $datas["codeConsultation"] = array();
        $datas["codePatient"] = array();
        $datas["decisionDoc"] = array();
        $datas["motif"] = array();
        $datas["anamnese"] = array();
        $datas["dateCons"] = array();
        $datas["nomPatient"] = array();
        $datas["suspicion"] = array();
        $datas["examComplem"] = array();
        $datas["codeParam"] = array();
        $where = "decision.codeDecision = consultation.codeDecision AND consultation.codePatient = patient.codePatient";
        $query =  $this->db->select("codeConsultation , consultation.codePatient as patientCode , nomPatient , decisionDoc , motif , dateCons , suspicion , examComplem , codeParam , anamnese")
                ->from("consultation , patient , decision")
                ->where($where)
                ->get()
                ->result();
        
        foreach($query as $data)
        
            {
                if(
                    preg_match("#^".$keywords."#i" , $data->nomPatient) || preg_match("#^".$keywords."#i" , $data->motif) || preg_match("#^".$keywords."#i" , $data->suspicion)
                    || preg_match("#^".$keywords."#i" , $data->decisionDoc) ||preg_match("#^".$keywords."#i" , $data->dateCons) || preg_match("#^".$keywords."#i" , $data->examComplem) || preg_match("#^".$keywords."#i" , $data->codeConsultation)
                    )
                    {
                    array_push($datas["codeConsultation"] , $data->codeConsultation);
                    array_push($datas["nomPatient"] , $data->nomPatient);               
                    array_push($datas["decisionDoc"] , $data->decisionDoc);               
                    array_push($datas["dateCons"] , $data->dateCons);               
                    array_push($datas["motif"] , $data->motif);               
                    array_push($datas["suspicion"] , $data->suspicion);               
                    array_push($datas["codePatient"] , $data->patientCode);
                    array_push($datas["examComplem"] , $data->examComplem);
                    array_push($datas["codeParam"] , $data->codeParam);
                    array_push($datas["anamnese"] , $data->anamnese);
                                                      
            }
        }/**/
        return $datas;
    }
    public function getConsultationFor($codePatient)
    {
        return $this->db->where("codePatient" , $codePatient)
                        ->get($this->table)
                        ->result();
    }
    public function updateConsultation($numConsultation , $codeTraitement)
    {
        $this->db->set(["codeTraitement" => $codeTraitement])
                ->where("codeConsultation" , $numConsultation);
        $this->db->update($this->table);
    }
    public function consulte()
    {
        $datas = array();
        $datas["codeConsultation"] = array();
        $datas["codePatient"] = array();
        $datas["decisionDoc"] = array();
        $datas["motif"] = array();
        $datas["anamnese"] = array();
        $datas["dateCons"] = array();
        $datas["nomPatient"] = array();
        $datas["suspicion"] = array();
        $datas["examComplem"] = array();
        $datas["codeParam"] = array();
        $where = "decision.codeDecision = consultation.codeDecision AND consultation.codePatient = patient.codePatient";
        return  $this->db->select("codeConsultation , consultation.codePatient as patientCode , nomPatient , decisionDoc , patient.codePatient, motif , dateCons , suspicion , examComplem , codeParam , anamnese")
                ->from("consultation , patient , decision")
                ->where($where)
                ->get()
                ->result();
    }

    public function chiffreAffaire($codeProprio)
    {
        $where = "facture_traitement.numTraitement = ligne_traitement.numTraitement AND medicament.codeMed = ligne_traitement.codeMed AND patient.codePatient = facture_traitement.codePatient AND proprietaire.codeProprio = patient.codeProprio";
    return        $this->db->select("sum(puDetail * qte) as prix , patient.codePatient  as codePatient, nomPatient, nomProprio , dateTraitement , facture_traitement.numTraitement as numero")
                ->from("medicament , patient , ligne_traitement , facture_traitement , proprietaire") 
                ->where($where)
                ->where("proprietaire.codeProprio" , $codeProprio )
                ->group_by("facture_traitement.numTraitement")
                ->get()
                ->result();

    }
    
    public function facturation()
    {
        $query = "SELECT unite , parPresentation , facture_traitement.numTraitement as numfact , dateTraitement as dates ,  libelleTrait , libelleMed , nomProprio , proprietaire.codeProprio ,adresseProprio , nomPatient , puDetail , qte , (puDetail * qte ) AS total FROM patient , proprietaire , ligne_traitement , facture_traitement , medicament , traitement where medicament.codeTrait = traitement.codeTrait AND ligne_traitement.factured = 1 AND patient.codeProprio = proprietaire.codeProprio AND facture_traitement.codePatient = patient.codePatient AND facture_traitement.numTraitement = ligne_traitement.numTraitement AND medicament.codeMed = ligne_traitement.codemed AND facture_traitement.numTraitement = ".$this->FactureTraitement->getLast();
        return $this->db->query($query)
                        ->result();
    }
    public function getCons($codeConsultation)
    {
        $sql = "SELECT unite , parPresentation , facture_traitement.numTraitement as numfact , dateTraitement as dates ,  libelleTrait , libelleMed , nomProprio , adresseProprio , nomPatient , puDetail , qte , (puDetail * qte ) AS total FROM patient , proprietaire , ligne_traitement , facture_traitement , medicament , traitement where medicament.codeTrait = traitement.codeTrait AND patient.codeProprio = proprietaire.codeProprio AND facture_traitement.codePatient = patient.codePatient AND facture_traitement.numTraitement = ligne_traitement.numTraitement AND medicament.codeMed = ligne_traitement.codemed AND facture_traitement.numTraitement = ".$codeConsultation;
        return $this->db->query($sql)
                        ->result();
    }
    public function statPerMonth($year = "")
    {
        if($year == "")
        return $this->db->select("count(codeConsultation) as counter, Month(dateCons) AS Month")
                        ->group_by("Month")
                        ->get($this->table)
                        ->result();
         return     $this->db->select("count(codeConsultation) as counter, Month(dateCons) AS Month")
                        ->group_by("Month")
                        ->where("Year(dateCons)" , $year)
                        ->get($this->table)
                        ->result();
    }
    public function getLast()
    {
        return $this->db->order_by("codeConsultation" , "DESC")
                        ->limit(1)
                        ->get($this->table)
                        ->result_array()[0]["codeConsultation"];
    }
}
