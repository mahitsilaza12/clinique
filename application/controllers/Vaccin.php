<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vaccin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("ModelProprietaire" , "Proprietaire");
        $this->load->model("ModelPatient" , "Patient");
        $this->load->model("ModelSoin" , "Soin");
        $this->load->model("ModelJoiner" , "Joiner");
        $this->load->model("ModelVaccin" , "Vaccin");
        $this->load->model("ModelMedicament" , "Medicament");
        $this->load->model("ModelFactureSoin" , "FactureSoin");
        $this->load->model("ModelLigneSoin" , "LigneSoin");
        $this->load->model("ModelRappel"  , "Rappel");
        if(!($this->session->has_userdata("state")))
        {
            $this->session->set_flashdata("login" , "Vous devez d'abord vous connecter");
            redirect(base_url()."welcome/login");
        }
    }
    public function index()
    {
        $this->load->view("templates/head" , ["titre" => "Vaccination"]);
        $this->load->view("vaccin/index");
        $this->load->view("templates/footer" , ["script" => "ajax/vaccin.js"]);
    }
    public function vacciner()
    {  

        $rappel = false;

        $codePatient = $this->input->post("codePatient");

        $remise = $this->input->post("remise") ? $this->input->post("remise") : 0;

        $patient = $this->Patient->get_patient($codePatient);

        $this->Vaccin->store($codePatient);
        
        $this->FactureSoin->store($codePatient);
        
        if($this->input->post("rappel") == 3)
        {
            $rappel = true;
        
            $this->Rappel->addRappel($codePatient , $this->input->post("dateRappel")  , "vaccin" , $this->Vaccin->getLast());
        }
        

        $data = array();
        $data["codeSoin"] = array();
        
        


        foreach($this->Soin->tarif() as $tarif)
            {
                if($this->input->post($tarif->rubrique) && $tarif->codeEspece == $patient[0]->codeEspece && $tarif->type == "Vaccination")
                    
                     {
                        
                            ($this->LigneSoin->store($tarif->codeSoin));
                            (array_push($data["codeSoin"], $tarif->codeSoin));
                    }
            }
            foreach($this->Medicament->liste() as $med)
                {
                    if(in_array($med->codeMed, $_POST))
                   
                        {

                            $this->Vaccin->storeLigneVaccin($med->codeMed , $this->input->post("qte".$med->libelleMed));
                            $this->Medicament->Stockage($this->input->post("qte".$med->libelleMed) , "-" , $med->codeMed);

                        }
            
            }
            
            $donne = array();
            
            foreach($data["codeSoin"] as $soin)
            {

                array_push($donne , $this->Soin->getSoin($soin));
                
            }
            $this->load->view("templates/head" , ["titre" => "Vaccination"]);
            $this->load->view("vaccin/index" , ["vaccin" => $donne , "codeProprio" => $patient[0]->codeProprio , "remise" => $remise]);
            $this->load->view("templates/footer" , ["script" => "ajax/vaccin.js"]);
            
        }
        public function facturer()
        {
            $this->load->model("ModelPayement" , "Payement");


            $this->load->library("Lettre");

            $this->load->library("html2pdf/html2pdf");
    
            $remise = $this->input->post("remise") ? $this->input->post("remise") : 0;

            $numfact = $this->FactureSoin->getLaster()[0]->numfactureSoin;
            
            $total = $this->LigneSoin->total($numfact);

            $total -= ($total * $remise) / 100;

            $data = $this->LigneSoin->facture($numfact);

            $paye = $this->input->post("payement");

            $this->Payement->insert($paye , $numfact , "vaccin", $total , $this->input->post("codeProprio") , $remise ,"soin/loader/".$numfact."/".$paye."/".$remise);
            
            redirect("soin/loader/".$numfact."/".$paye."/".$remise);

        }
}
