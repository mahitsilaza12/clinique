<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consultation extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("ModelConsultation" , "Consultation");
        $this->load->model("ModelPatient" , "Patient");
        $this->load->model("ModelDecision" , "Decision");
        $this->load->model("ModelSoin" , "Soin");
        $this->load->model("ModelRappel" , "Rappel");
        $this->load->model("ModelFactureSoin" , "FactureSoin");
        $this->load->model("ModelLigneSoin" , "LigneSoin");
        $this->load->model("ModelJoiner" , "Join");
        $this->load->model("ModelMedicament" , "Medicament");
        $this->load->model("ModelHospital" , "Hospital");
        $this->load->model("ModelLigneTraitement" , "LigneTraitement");
        $this->load->model("ModelFactureTraitement" , "FactureTraitement");
        $this->load->model("ModelPayement" , "Payement");

        if(!($this->session->has_userdata("state")))
        {
            $this->session->set_flashdata("login" , "Vous devez d'abord vous connecter");
            redirect(base_url()."welcome/login");
        }
    }
    public function download()
    {
        $this->load->view("consult/liste" , ["listeConsult" => $this->Consultation->consulte()]);
    }
    public function index()
    {
        $this->load->view("templates/head" , ["titre" => "Consultation"]);

        $this->load->view("consult/cons");

        $this->load->view("templates/footer" , ["script" => "ajax/cons.js"]);    
    }

    public function search($keyword)
    {
        $result = ($this->Consultation->search($keyword));
      for($i = 0 ; $i < (count($result["codeConsultation"])) ; $i++)
        {
                echo "
                <tr>
                    <td><a href='".base_url()."consultation/fact/".$result["codeConsultation"][$i]."'>C".$result["codeConsultation"][$i]."</a></td><td>"
                        ."<a href=".base_url()."patient/profil/".$result["codePatient"][$i].">".$result["nomPatient"][$i]."</td><td>"
                        .$result["motif"][$i]."</td><td>"
                        .$result["anamnese"][$i]."</td><td>"
                        .$result["suspicion"][$i]."</td><td>"
                        .$result["examComplem"][$i]."</td><td><button type='button' class='btn btn-outline-secondary btn-sm' data-toggle='modal' data-target='#exampleModal' onclick='parametre(".$result["codeParam"][$i].")'>Voir le parametre</button></td><td>"
                        .$result["decisionDoc"][$i]."</td><td>"
                        .$result["dateCons"][$i]."</td>"
                ."</tr>";
            }
    }

    public function count()
    {
        echo $this->Consultation->count();
    }
    public function ordonnance()
    {
        $this->load->library("html2pdf/html2pdf");
        $this->load->view("consult/ordonnance" , ["facture" => $this->Consultation->facturation()]);   
    }

    public function store()
    {
        $data = [
            "motif" => $this->input->post("motif") ,
            "suspicion" => $this->input->post("suspicion") ,
            "examComplem" => $this->input->post("examComplem") ,
            "codeParam" => $this->input->post("codeParam") ,
            "anamnese" => $this->input->post("anamnese"),
            "codeDecision" => (int)$this->input->post("codeDecision") ,
            "codePatient" => $this->input->post("codePatient"),
            "dateRappel" => $this->input->post("dateRappel"),
            "dateDebut" => $this->input->post("dateDebut"),
            "dateFin" => $this->input->post("dateFin"),
        ]; 

        $i = 0;
        
        foreach($this->Medicament->liste() as $medicament)
        {
            if($this->input->post("qte".$medicament->libelleMed) != "" && $this->input->post("facture_".$medicament->libelleMed))
                {
                    $i++;
                }
        }

        if($i != 0)
        {

            $this->FactureTraitement->traiter($data);    

            $codePatient = $this->input->post("codePatient");

            $this->FactureSoin->store($codePatient , true);

            $this->Consultation->insertion($data);

                foreach($this->Medicament->liste() as $medicament)
                {
                    if($this->input->post("qte".$medicament->libelleMed) != "" && $this->input->post("facture_".$medicament->libelleMed))
                        {
                            $this->LigneTraitement->store($medicament->codeMed , $this->input->post("qte".$medicament->libelleMed));
                        }
                    else if($this->input->post("qte".$medicament->libelleMed) != "" && !$this->input->post("facture_".$medicament->libelleMed))
                        {
                            $this->LigneTraitement->store($medicament->codeMed , $this->input->post("qte".$medicament->libelleMed) , false);
                        }
                }

        
            $this->load->library('Lettre');

            $patient = $this->Join->profil($data["codePatient"])[0];
            
            $remise = ($this->input->post("remise")) ? ($this->input->post("remise")) : 0;

                    
        foreach($this->Soin->tarif() as $tarif)
                {
                    if(in_array($tarif->rubrique , $_POST) && ($tarif->codeEspece == $patient->codeEspece) && $tarif->type == "Traitement")
                            $this->LigneSoin->store($tarif->codeSoin);                                    
                }
        $day = 1;

        $numfact = $this->ModelFactureSoin->getLast();
         
        $donnee = $this->LigneSoin->facture($numfact) ;

        
                    
                            
                $this->Consultation->updateConsultation($this->Consultation->getLast() , $this->FactureTraitement->getlast());
                
                if($this->input->post("codeDecision") == 3)
                {
                    $this->Rappel->addRappel($data["codePatient"] , $data["dateRappel"] , "traitement" , $this->FactureTraitement->getlast());
                }
                else if($this->input->post("codeDecision") == 2)
                {
                    $this->Hospital->store($data["codePatient"] , $data["dateDebut"] , $data["dateFin"]);
                    
                    $data["dateDebut"] = date_create($data["dateDebut"]);
                    $data["dateFin"] = date_create($data["dateFin"]);
                    $day = (date_diff($data["dateDebut"] , $data["dateFin"])->days);
                
                }          
            $this->load->view("consult/facture" , ["facture" => $this->Consultation->facturation() , "remise" => $remise , "codeProprio" => $patient->codeProprio , "soinFaite" => $donnee , "day" => $day]);
        }
        else
        {
           $this->load->view("consult/facture" , ["donnee" => "vide"]);
        }
    }

    public function getWithMed()
    {
        $this->load->model("ModelJoiner" , "Join");  
        echo $this->Join->traitementWithMed();
    }
    public function stock($codeMed , $qte)
    {
        echo json_encode($this->Medicament->stockInsuffisant($qte , $codeMed));  
    }
    public function consultationFor($codePatient)
    {
        foreach($this->Consultation->getConsultationFor($codePatient) as $consultation)
        {
            echo "
                <tr>
                    <td>C".$consultation->codeConsultation."</a></td><td>"
                    ."<a href=".base_url()."patient/profil/".$consultation->codePatient.">".$this->Patient->getname($consultation->codePatient)[0]["nomPatient"]."</a></td><td>"
                        .$consultation->motif."</td><td>"
                        .$consultation->anamnese."</td><td>"
                        .$consultation->suspicion."</td><td>"            
                        .$consultation->examComplem."</td><td><button type='button' class='btn btn-outline-secondary btn-sm' data-toggle='modal' data-target='#exampleModal' onclick='parametre(".$consultation->codeParam.")'>Voir le parametre</button></td><td>"
                        .$this->Decision->getDecision($consultation->codeDecision)."</td><td><button type='button' class='btn btn-outline-primary btn-sm' data-toggle='modal' onclick='getTraitement(".$consultation->codeTraitement.")' data-target='#mod'>TRAITEMENT</button></td><td>"           
                        .$consultation->dateCons."</td>"
                ."</tr>";            
        }
    }

    public function facture($numfact)
    {
        $day = ($this->input->post("day")) ? $this->input->post("day") : "";
        $this->load->model("ModelPayement" , "Payement");
        $remise = $this->input->post("remise");
        if(!$this->input->post("remise"))
            $remise = 0;
        $net = $this->input->post("net") + (($this->input->post("net") * $this->input->post("remise")) / 100);

        $this->Payement->insert($this->input->post("payee") , $numfact , "traitement" , $net , $this->input->post("codeProprio") , $remise ,  "consultation/loader/".$remise."/".$this->input->post("payee")."/".$day);

        redirect("consultation/loader/".$remise."/".$this->input->post("payee")."/".$day);

    }

    public function loader($remise, $payee , $day = "")
    {
        $numfact = $this->FactureSoin->getLast();
        $donnee = $this->LigneSoin->facture($numfact) ;

        $this->load->library('Lettre');
        $this->load->library("html2pdf/html2pdf");
        $this->load->view("consult/facturation" , [
            "facture" => $this->Consultation->facturation() ,
            "remise" => $remise,
            "payee" => $payee,
            "soinFaite" => $donnee,
            "day" => $day
        ]);

    }
    public function fact($codeFact)
    {
        $this->load->view("templates/head");
        $this->load->view("facture/see" , ["fact" =>$this->Consultation->getCons($codeFact)]);
        $this->load->view("templates/footer");
    
    }
    public function statMonth($year = '')
    {
       echo json_encode($this->Consultation->statPerMonth($year));
    }
}
