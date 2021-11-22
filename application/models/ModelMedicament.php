<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelMedicament extends CI_Model
{
    protected $table = "medicament";
    public function __construct()
    {
        parent::__construct();
    }
    public function update($codeMed , $puDetail , $puPres , $libelle , $stock , $date)
    {
        return $this->db->set([
            "libelleMed" => $libelle ,
            "puDetail" => $puDetail ,
            "prixPresentation" => $puPres,
            "stock" => $stock,
            "datePeremption" => $date
            ])->where("codeMed" , $codeMed)->update($this->table) ? true : false;
    }
    public function liste()
    {
        return $this->db->order_by("libelleMed" , "ASC")
                        ->get($this->table)
                        ->result();
    }
    public function Stockage($qte , $operation , $codemed)
    {
        $sql = "UPDATE medicament set stock = stock ".$operation." ? where codeMed = ?";
        return $this->db->query($sql , array( $qte , $codemed)) ? true : false;
    }
    public function updateDate($date , $codeMed)
    {
        $sql = "UPDATE medicament set  datePeremption =  ? where codeMed = ?";

        return $this->db->query($sql , array( $date , $codeMed)) ? true : false;
    }
    public function get_med($codeMed)
    {
        return $this->db->select()
                    ->where("codemed" , $codeMed)
                    ->get($this->table)
                    ->result_array()[0];
    }
    public function showByTraitement($traitement = "" )
    {
        $where = "medicament.codeTrait = traitement.codeTrait";
        if($traitement)
        {

            return $this->db->select()
                            ->where($where)
                            ->where("medicament.codeTrait" , $traitement)
                            ->order_by("libelleMed" , "ASC")
                            ->get($this->table." , traitement")
                            ->result();
        }
        else
        {
         return $this->db->select()
                            ->where($where)
                            ->order_by("libelleMed" , "ASC")
                            ->get($this->table." , traitement")
                            ->result();   
        }
}
        public function showByLibTraitement($traitement = "" )
        {
                $where = "medicament.codeTrait = traitement.codeTrait";
                if($traitement)
                {

                    return $this->db->select()
                                    ->where($where)
                                    ->where("libelleTrait" , $traitement)
                                    ->order_by("datePeremption" , "DESC")
                                    ->get($this->table." , traitement")
                                    ->result();
                }
                return $this->db->select()
                                ->where($where)
                                ->order_by("medicament.codeTrait")
                                ->order_by("datePeremption" , "DESC")
                                ->get($this->table." , traitement")
                                ->result();
        }
    public function storeMedicament($donnee)
    {   
        $data = array(
            "libelleMed" => $donnee["libelleMed"],
            "unite" => $donnee["unite"],
            "description" => $donnee["description"],
            "puDetail" => $donnee["puDetail"],
            // @ update vô miasa "datePeremption" => $donnee["datePeremption"],
            "presentation" => $donnee["presentation"],
            "parPresentation" => $donnee["parPresentation"],
            "presentationGros" => $donnee["presentationGros"],
            "codeTrait" => $donnee["codeTrait"],
            "prixPresentation" => $donnee["prixPresentation"]
        );

        $this->db->set($data);
        return ($this->db->insert($this->table)) ? true : false;
    }
    public function stockInsuffisant($qte , $codeMed)
    {
        $query =  $this->db->select()
                        ->where("codeMed" , $codeMed)
                        ->where("stock <" , $qte)
                        ->get($this->table);

        return ($query->num_rows() > 0) ? true : false;

        //TRUE si le medicament est en rupture de stock
    }

    public function delete($codeMed)
    {
        $this->db->where("codeMed" ,  $codeMed);
        return ($this->db->delete($this->table)) ? true : false;
    }
    public function changePu($taux , $codeMed = "" , $codeTrait = "")
    {
        $taux = $taux/100;

        $this->db->set("puDetail" , "puDetail + ".$taux);

        return $this->db->update($this->table)? true : false; 
    }
    public function stock()
    {
        return $this->db->select()
                    ->where("(stock) <" , 2)
                    ->where("medicament.codeTrait = traitement.codeTrait")
                    ->get($this->table.",traitement")
                    ->result();
    }
    public function datePeremption()
    {
        return $this->db->select()
                        ->where("DATEDIFF(datePeremption , NOW()) < 7")
                        ->where("stock != 0")
                        ->where("medicament.codeTrait = traitement.codeTrait")
                        ->get($this->table.",traitement")
                        ->result();
    }
    public function search($keyword)
    {
        return $this->db->select("codeMed , libelleMed  , unite , stock , description,puDetail , presentationGros , presentation, parPresentation , datePeremption")
                        ->like( "libelleMed" , $keyword , "both")
                        ->or_like("unite" , $keyword , "after")
                        ->or_like("description" , $keyword , "both")
                        ->or_like("presentationGros" , $keyword)
                        ->or_like("presentation" , $keyword)
                        ->or_like("datePeremption" , $keyword)
                        ->get($this->table)
                        ->result();
    }

    public function getMedicament($codeMed)
    {
        return $this->db->select()
                        ->where("codeMed" , $codeMed)
                        ->get($this->table)
                        ->result();
    }
    public function see_med($codemed)
    {
        return $this->db->select()
                        ->where("traitement.codeTrait = medicament.codeTrait")
                        ->where("medicament.codeMed" , $codemed)
                        ->get("traitement , medicament")
                        ->result();
    }
    public function see_meds($med)
    {
        return $this->db->select()
                        ->where("traitement.codeTrait = medicament.codeTrait")
                        ->like("traitement.libelleTrait" , $med , "after")
                        ->get("traitement , medicament")
                        ->result();
    }
}