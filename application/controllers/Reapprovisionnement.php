<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reapprovisionnement extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("ModelMedicament" , "Medicament");
        $this->load->model("ModelCommande" , "Commande");
        // $this->load->model("ModelConsultation" , "Consultation");
        if(!($this->session->has_userdata("state")))
        {
            $this->session->set_flashdata("login" , "Vous devez d'abord vous connecter");
            redirect(base_url()."welcome/login");
        }
    }
    public function liste($date1 = "" , $date2 = "")
    {
         $data = $this->Commande->liste($date1 , $date2);            
            $this->load->view("appro/excel" , ["liste" => $data]);
        
    }

    public function index()
    {
        $this->load->view("templates/head" , ["titre" => "Réapprovisionnement"]);
        $this->load->view("appro/index" , ["liste" => $this->Commande->liste()]);
        $this->load->view("templates/footer" , ["script" => "ajax/comfrs.js"]);
    } 
    public function store()
    {
        $dataFact = array();
        
        $j = 0;
            
        

       $codeFrs = $this->input->post('codeFrs');
        
        $this->Commande->store($codeFrs);

        foreach($this->Medicament->liste() as $medicament)
        {
            if($this->input->post("qte".$medicament->libelleMed) != "")
                {
                    $dataFact[$j][$this->input->post($medicament->libelleMed)] = $this->input->post("qte".$medicament->libelleMed);
                   
                    $j++;
                }
        }

        if((count($dataFact)) > 0)
            {
            for($i = 0; $i < (count($dataFact)) ; $i++)
                    {
                        foreach($dataFact[$i] as $med => $qte)
                            $response = $this->Commande->storeLigne($med , $qte) && $this->Medicament->updateDate($this->input->post("datePeremption".$med) , $med);
                    }
            }
            if($response == true)
            {
                $payement = $this->Commande->getLigneCommande($this->Commande->get_last());
                $data = $this->Commande->factureLigne($payement[0]->numcom);
            }
            $this->load->view("templates/head");
            $this->load->view("appro/appro" , ["appro" => $data]);
            $this->load->view("templates/footer");
            
                
            }
    public function facture($codeCom)
    {
        echo json_encode($this->Commande->factureLigne($codeCom));
    }
    public function update($codeCom)
    {
        $fact = $this->Commande->factureLigne($codeCom);
        $montant = 0;
        foreach($fact as $d)
        {
            $montant += $d->somme;
        }
        if($this->Commande->update($codeCom , $this->input->post("payee") , $this->input->post("dateFin") , $montant));

                redirect(base_url()."finance");
    }
}