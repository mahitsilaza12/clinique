<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelPayement extends CI_Model
{
    protected $table = "payement_client";
    protected $table2 = "payement_frs";
    public function alertFinance()
    {
        return $this->db->select()
                        ->where("net != payee")
                        ->get($this->table2)
                        ->result();
    }
    public function insert($payee , $numfact , $type , $total , $codeProprio , $remise , $url = ''){
    $paye = ($paye < $total) ? $paye : $total;
    $this->db->set([
        "payee" =>$payee,
        "numfact" => $numfact,
        "type" => $type,
        "net" =>$total,
        "codeProprio" => $codeProprio,
        "date" => date("Y-m-j"),
        "remise" => $remise,
        "url" => $url
    ]);
        $this->db->insert($this->table);
    }


    public function reglement($codepaye , $payee)
    {
        $sql = "UPDATE payement_frs set payee = payee + ".$payee." WHERE codePayement = ".$codepaye;

        return $this->db->query($sql);
    }
    public function reglement_cli($codepaye , $payee)
    {
        $url = ($this->getPayement($codepaye))->url;
            

        $array_data = explode("/" , $url);
        
        //Les payées vont être mis à jour
        
        $array_data[3] += $payee;

        $url = implode("/" , $array_data);

        $sql = "UPDATE payement_client set payee = payee + ".$payee.", url = '".$url."' WHERE codeComCli = ".$codepaye;

        return $this->db->query($sql);
    }
    public function depense($year = "" )
    {
        if($year == "")
            $year = date("Y");
          
        return $this->db->select("MONTHNAME(dateFin) as month , SUM(net) as depense")
                        ->where("YEAR(dateFin) " , $year)
                        ->group_by("MONTHNAME(dateFin)")
                        ->get($this->table2)
                        ->result();
                        
    }
    public function entre($year = "")
    {
        if($year == "")
            $year = date("Y");
        return $this->db->select("MONTHNAME(date) as month , SUM(net) as entre")
            ->where("YEAR(date) " , $year)
            ->group_by("MONTHNAME(date)")
            ->get($this->table)
            ->result();
        
    }

    public function getPayement($numFact)
    {
        return $this->db->select()
                        ->where("codeComCli" , $numFact)
                        ->get($this->table)
                        ->result()[0];
    }

}