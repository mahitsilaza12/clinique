<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Soin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("ModelSoin" , "Soin");
        $this->load->model("ModelFactureSoin" , "FactureSoin");
        $this->load->model("ModelMedicament" , "Medicament");
        $this->load->model("ModelLigneSoin" , "LigneSoin");
        $this->load->model("ModelPatient" , "Patient");
        $this->load->model("ModelJoiner" , "Join");
        if(!($this->session->has_userdata("state")))
        {
            $this->session->set_flashdata("login" , "Vous devez d'abord vous connecter");
            redirect(base_url()."welcome/login");
        }
    }
    public function index()
    {
        $this->load->view("templates/head" , ["titre" => "Soin"]);
        $this->load->view("soin/index");
        $this->load->view("templates/footer" , ["script" => "ajax/soin.js"]);
    }
    public function show()
    {
        echo json_encode($this->Soin->tarif());
    }

    public function search($keywords)
    {
        echo json_encode($this->Soin->search($keywords));
    }
    public function store()
    {
        $espece = $this->input->post("espece") ? $this->input->post("espece") : 0;

        echo json_encode($this->Soin->insert($this->input->post("rubrique") , $this->input->post("prix"), $this->input->post("description") , $espece , $this->input->post("type")));
    }
    
    public function soigner()
    { 
            $this->load->model("ModelFactureSoin");
            $this->load->library("Lettre");
            
            $this->load->library("html2pdf/html2pdf");

            $codePatient = $this->input->post("codePatient");
            
            $this->FactureSoin->store($codePatient);
            
            $patient = $this->Join->profil($codePatient);

            $remise = ($this->input->post("remise")) ? ($this->input->post("remise")) : 0;

                            foreach($this->Soin->tarif() as $tarif)
                            {
                                if(in_array($tarif->rubrique , $_POST) && ($tarif->codeEspece == $patient[0]->codeEspece) && $tarif->type == "Soin")
                                    
                                     $this->LigneSoin->store($tarif->codeSoin);                                    
                            } 
                            foreach($this->Medicament->liste() as $medicament)
                            {
                                if(array_key_exists($medicament->libelleMed , $_POST))
                                {
                                    if(isset($_POST["Type".$medicament->libelleMed]) && $_POST["Type".$medicament->libelleMed] == "nouveau")
                                            $this->Medicament->Stockage(1 , "-", $medicament->codeMed);
                                    else if(isset($_POST["qte".$medicament->libelleMed]))
                                            $this->Medicament->Stockage($_POST["qte".$medicament->libelleMed] , "-", $medicament->codeMed);
                                }
                            }
                //On diminue seulement si on utilise un nouveau produit
                            $numfact = $this->ModelFactureSoin->getLast();
                            
                            $donnee = $this->LigneSoin->facture($numfact) ;
                            
                            
                                $net = 0;
                                $head = '<table style="width:90%;margin:50px auto 10px auto;height: 400px;border-collapse: collapse;border:1px solid black;text-align: center">
                    <tr>
                        <td  style="border-bottom:1px solid black;padding-bottom: 10px" colspan="3">Déscription des soins :</td>
                    </tr>
                    <tr>
                        <th style="width: 50%;border:1px solid black">Soin faite</th>
                        <th style="width: 50%;border:1px solid black">Prix</th>
                        <th style="width: 10%;border:1px solid black">Total</th>
                    </tr>';


                    $content = '';
                    foreach ($donnee as $key) { 
                    $content .= '
                    <tr>
                        <td style="border:1px solid black">'.$key->rubrique.'</td>
                        <td style="border:1px solid black">'.($key->prix).'</td>
                        <td style="border:1px solid black">'.($key->prix).'</td>
                    </tr>';
                $net += $key->prix;
                }
                $net = (int)($net);
                $text_remise = "";
                $Montant = $net - (($net * $remise) / 100);
                if($remise != 0)
                {
                    $text_remise = '
<tr>
                    <td style="border:1px solid black"></td>    
                <td style="border:1px solid black"><strong>Somme total</strong></td>
                <td style="border:1px solid black">'.($net).'Ar</td>
                </tr>
                <tr>
                <td style="border:1px solid black"></td>    
                <td style="border:1px solid black"><strong>Remise</strong></td>
                <td style="border:1px solid black">'.($remise).'%</td>
                </tr>
                
                ';
                }

                $foot = '<tr>
                <td style="border:1px solid black"></td>	
                <td style="border:1px solid black"><strong>Net à payer</strong></td>
                <td style="border:1px solid black">'.($Montant).'Ar</td>
                </tr>
                </table>
                <div>

                <form method="POST" action ="'.base_url().'soin/facture/'.$numfact.'">
                <div class="form-group">
                            <label>A Payer maintenant :</label>
                            <input min="0" name="payement" type="number" class="form-control form-control-sm col-2" >
                            </div>
                            <input type="hidden" name="remise" value='.$remise.'>
                            <input type="hidden" name="codeProprio" value='.$patient[0]->codeProprio.'>
                        <button type="submit" class="btn btn-success btn-sm mt-2 col-4" style="text-align:center"><i class="fa fa-download"></i></button>
                <form>
                </div>';

                echo $head.$content.$text_remise.$foot;
    
    }
    public function soin($type , $espece = "")
    {
        $espece = ($espece == "") ? "" : $this->Patient->get_patient($espece)[0]->codeEspece;
            echo json_encode($this->Soin->getAll($type , $espece));
    }
    public function delete($codeSoin)
    {
        echo json_encode($this->Soin->delete($codeSoin));
    }
    public function price($nom)
    {
        echo json_encode($this->Soin->getPriceByName($nom));
    }
    public function getSoin($codeSoin)
    {
        echo json_encode($this->Soin->getSoin($codeSoin));
    }
    public function changeAll($taux)
    {
        echo json_encode($this->Soin->updateAll($taux));
    }
    public function update()
    {
        $espece = $this->input->post("codeEspece") ? $this->input->post("codeEspece") : 0;
        $data = [
            'rubrique' => $this->input->post('rubrique'),
            'prix' => $this->input->post('prix'),
            'description' => $this->input->post('description'),
            'codeEspece' => $espece,
            'type' => $this->input->post('type'),
        ];
        echo json_encode($this->Soin->updateSoin($data , $this->input->post('codeSoin')));
    }
    public function see($codePatient)
    {
        foreach($this->LigneSoin->see($codePatient) as $soin)
        {
            echo "
            <tr>
            <td>".$soin->numfact."</td>
            <td>".$soin->rubrique."</td>
            <td>".$soin->dateSoin."</td>
            </tr>
            ";
        }
            }


    public function facture($numfact)
    {

        $this->load->model("ModelPayement" , "Payement");
        
        $remise = $this->input->post("remise") ? $this->input->post("remise") : 0;

        $total = $this->LigneSoin->total($numfact);

        $total -= ($total * $remise) / 100;

        $paye = $this->input->post("payement") ? $this->input->post("payement") : 0;

        
        $this->Payement->insert($paye , $numfact , "soin", $total , $this->input->post("codeProprio") , $remise , "soin/loader/".$numfact."/".$paye."/".$remise);

        redirect("soin/loader/".$numfact."/".$paye."/".$remise);
    }
    public function loader($numfact , $paye , $remise)
    {
        $this->load->library("Lettre");

        $this->load->library("html2pdf/html2pdf");

        $donnee = $this->LigneSoin->facture($numfact);

        $this->load->view("soin/depense" , ["facture" => $donnee , "payee" => $paye , "remise" => $remise ]); 
    }
    public function seeWithProprio($codeProrio)
    {
        echo json_encode($this->LigneSoin->seeWithProprio($codeProrio));
    }
}