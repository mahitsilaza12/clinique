<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Finance extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("ModelPayement" , "Payement");

        if(!($this->session->has_userdata("state")))
        {
            $this->session->set_flashdata("login" , "Vous devez d'abord vous connecter");
            redirect(base_url()."welcome/login");
        }
    } 
    public function remiser()
    {
        $this->load->model("ModelJoiner" , "Join");
        
        echo json_encode($this->Join->remiser($this->input->post("remise")));


    }
    public function alert()
    {
        echo json_encode($this->Payement->alertFinance());
    }
    public function depense($year = "")
    {
        echo json_encode($this->Payement->depense($year));
    }
    public function entre($year = "")
    {
        echo json_encode($this->Payement->entre($year));
    }
    public function index()
    {
        

        $this->load->model("ModelJoiner" , "Join");
        $this->load->model("ModelFactureSoin" , "FactureSoin");

        $data = $this->Join->liste_appro();
        $soin = $this->Join->liste_depense();

        if($this->input->post("date1") && $this->input->post("date2"))
            $soin = $this->Join->liste_depense($this->input->post("date1") , $this->input->post("date2"));
        $this->load->view("templates/head" , ["titre" => "Finance"]);
        $this->load->view("finance/index" , ["data" => $data , "soin" => $soin , "date1" => $this->input->post("date1") , "date2" => $this->input->post("date2")]);
        $this->load->view("templates/footer" , ["script" => "ajax/finance.js"]);
    
    }
    public function download($type , $date1 = "" , $date2 = "")
    {
        if($type == "fournisseur")
        {
            if($date1 != "")
            {
                $this->load->model("ModelJoiner" , "Join");
                $this->load->model("ModelFactureSoin" , "FactureSoin");
                $data = $this->Join->liste_appro($date1 , $date2);
                $this->load->view("finance/finance_frs" , ["data" => $data]);
            }
            else
            {
                $this->load->model("ModelJoiner" , "Join");
                $this->load->model("ModelFactureSoin" , "FactureSoin");
                $data = $this->Join->liste_appro();
                $this->load->view("finance/finance_frs" , ["data" => $data]);
            }
        }
        else
        {
            if($date1 != "")
            {
                $this->load->model("ModelJoiner" , "Join");
                $this->load->model("ModelFactureSoin" , "FactureSoin");
                $soin = $this->Join->liste_depense($date1 , $date2);
                $this->load->view("finance/finance_cli" , ["soin" => $soin]);
            }
            else
            {
                $this->load->model("ModelJoiner" , "Join");
                $this->load->model("ModelFactureSoin" , "FactureSoin");
                $soin = $this->Join->liste_depense();
                $this->load->view("finance/finance_cli" , ["soin" => $soin]);
            }
        }
    }
    public function regler($codeComCli)
    {
        $this->load->model("ModelJoiner" , "Join");

        $facture = $this->Join->getPayement($codeComCli);

        $this->load->view("templates/head" , [ "titre" => "Réglement" ,"second" => "Fournisseur"]);
        $this->load->view("finance/regler_frs" , ["facture" => $facture]);
        $this->load->view("templates/footer");
    }
    public function regler_cli($codeComCli)
    {
        $this->load->model("ModelJoiner" , "Join");

        $facture = $this->Join->getPayement_Cli($codeComCli);

        $this->load->view("templates/head" , ["titre" => "Réglement" ,"second" => "Client"]);
        $this->load->view("finance/regler_cli" , ["facture" => $facture]);
        $this->load->view("templates/footer");
    }
    public function reglement($codepaye)
    {
        $this->load->model("ModelPayement" , "Payement");
        if($this->Payement->reglement($codepaye , $this->input->post("payee")))
            {
    
                redirect("finance/");
    
            }
    }
    public function reglement_cli($codepaye)
    {
        $this->load->model("ModelPayement" , "Payement");
        if($this->Payement->reglement_cli($codepaye , $this->input->post("payee")))
            {redirect("finance/");}
    }

    public function reload( $codepaye)
    {
        $url = ($this->Payement->getPayement($codepaye))->url;

        echo $url;

        $array_data = explode("/" , $url);
        var_dump($array_data  );
    }
}