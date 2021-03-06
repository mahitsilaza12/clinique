<?php

/**
 * C'est une classe qui permet de convertir une chiffre en lettre
 */
class Lettre
{
	function __construct()
	{

	}
	public function decomposition($n , $cpt)
	{
$cpt = substr($n, strlen($n),1);
while(strlen($n)<3)
	{
		$n='0'.$n;
	}
	
		if(strlen($n) == 3)
		{
			$C=substr($n,0,1);
			$D=substr($n,1,1);
			$U=substr($n,2,1);
		}

$valeur='';

$chiffre=array('', 'un', 'deux', 'trois', 'quatre', 'cinq', 'six', 'sept', 'huit', 'neuf', 'dix', 'onze', 'douze', 'treize', 'quatorze', 'quinze', 'seize', 'dix-sept', 'dix-huit', 'dix-neuf');

$nombre=array('', 'dix', 'vingt', 'trente', 'quarante', 'cinquante', 'soixante', 'soixante-dix', 'quatre-vingt', 'quatre-vingt-dix');

	if($D==0)
	{
		$valeur=$chiffre[$U];
	} 							// 1 à 10 (ne retourne pas "zero" pour 0)
	
	elseif($D==1){$valeur=$chiffre[$U+10];} 					// 11 à 19
	
	elseif($D>=2 && $D<=6){										// 20 à 69
	
		if($U==0){$valeur=$nombre[$D];}								// x0
	
		elseif($U==1){$valeur=$nombre[$D].' et un';}				// x1
	
		else{$valeur=$nombre[$D].'-'.$chiffre[$U];}					// x2 à x9
	}
	
	elseif($D==7){$valeur=$nombre[6].'-'.$chiffre[$U+10];}		// 70 à 79
	
	elseif($D==8){												// 80 à 89
	
		if($U==0){
	
			if($cpt!=1){$valeur=$nombre[$D].'s';}				// tous les 80 sauf ...
	
			else{$valeur=$nombre[$D];}							// 80 000 => quatre-vingt mille (cas particulier)
		}
	
		else{$valeur=$nombre[$D].'-'.$chiffre[$U];}				// 81 à 89
	}
	
	elseif($D==9){$valeur=$nombre[8].'-'.$chiffre[$U+10];}		// 90 à 99
	//centaines
	
	if($C==1){													//1xx
	
		if(strlen($valeur)==0){$valeur='cent';}						// 100
	
		else{$valeur='cent'.' '.$valeur;} 							// 101 à 199
	}	// 1xx				
	
	elseif($C!=0){												// 2xx à 9xx
	
		if(strlen($valeur)==0){										// [2-9]00
	
			if($cpt==1){$valeur=$chiffre[$C].' cent';}					// cas particulier (ex: 300 000 : trois cent mille)
			else{$valeur=$chiffre[$C].' cents';}						// [2-9]00 ... le reste (ex: 300 000 000 : trois cents millions)
		}
	
		else{$valeur=$chiffre[$C].' cent '.$valeur;}				// le reste
	}
	
	else{}														// 0xx
	//nettoyage
	
	unset($n,$C,$D,$U,$chiffre,$nombre,$esp);
	//renvoi
	
	return $valeur;

	}
	public function nombre($montant)
	{
		if(!preg_match('/^[,\.0-9]+$/',$montant)){return false;}
		
		else{
			// Initialisation
			$retour='';
			// Paramétrage
			$devise=array("S"=>'Ariary', "P"=>'Ariary');						// devise "entière"
			$ssdevise=array("S"=>'centime', "P"=>'centimes');				// devise "décimales"
			// Préparation
			if(preg_match('/,/',$montant)){$montant=preg_replace('/,/','.',$montant);}//on remplace la virgule potentielle par un point

			if(preg_match('/\./',$montant)){$temp=explode('.',$montant);}
			else{$temp=array(0=>$montant,1=>'00');}

			$valeur["e"]=$temp[0];											// valeur entière
			$valeur["d"]=round("0.".$temp[1],2)*100;						// valeur décimale (arrondie à 2 chiffres)
			unset($temp);													// nettoyage
			// decomposition
			if($valeur["e"]==0 || $valeur["e"]==''){
				if($montant==0){ return "zero ".$devise["S"];}				//pas de décimales => retour : "zero ..."
				else{$retour='';} 											// il y a des décimales => pas de zero
			}
			elseif($valeur["e"]==1){$retour="un ".$devise["S"];}
			else{
				//gestion des noms par milliers
				$milliers=array('','mille','million','milliard','billion','billiard','trillion','trilliard','quadrillion','quadrilliard','quintillion','quintilliard','sextillion','sextilliard','septillion','septilliard','octillion','octilliard','nonillion','nonilliard','decillion','decilliard');
				//récupérer des chaines par milliers
				while(strlen($valeur["e"])%3!=0){$valeur["e"]='0'.$valeur["e"];} //d'abord compléter la chaine si besoin (multiple de 3 chiffres)
				$chaine=$valeur["e"];
				$cpt=0;
				while(strlen($chaine)>0){
					$souschaine=substr($chaine,strlen($chaine)-3,3);
					if($souschaine!="000")								// pas de traitement si nul
					{
						$temp=$this->decomposition($souschaine,$cpt);
						switch($temp){
							case '': $retour.=' - erreur sur le millier n°'.($cpt+1).' - ';	break;
							case 'un':	if($cpt==1){$retour=$milliers[$cpt].' '.$retour;} 	// 1xxx : pas de "un mille ..." mais "mille ..."
										else{$retour='un '.$milliers[$cpt].' '.$retour;}	// un ... le reste (million, milliard, etc...)
								break;
							default:	if($cpt==0){$retour=$temp.' '.$milliers[$cpt].' '.$retour;}		// pas de "millier dans ce cas"
										elseif($cpt==1){$retour=$temp.' '.$milliers[$cpt].' '.$retour;}	// "mille" pas "milles"
										else{$retour=$temp.' '.$milliers[$cpt].'s '.$retour;} 			// X (millions, milliards, etc...)
								break;
						}
					}
					//préparation pour la suite
					$chaine=substr($chaine,0,strlen($chaine)-3);			// on supprime les 3 derniers chiffres
					$cpt++;													// on passe aux milliers supérieurs
				}
				unset($temp,$cpt,$chaine, $souschaine);						// nettoyage
				$retour=trim($retour).' '.$devise["P"];						// d'office pluriel, car 0 et 1 traités à part
			}
			/* chiffres décimaux */
		if($valeur["d"]==0 || $valeur["d"]==''){}						// rien à rajouter
		elseif($valeur["d"]==01){$retour.=' un '.$ssdevise["S"];}		// ajout du centième
		else{

				$temp=$this->decomposition($valeur["d"],-1);
					if(strlen($temp)>0){$retour.=' '.$temp.' '.$ssdevise["P"];}	// ajout des autres possibilités
				unset($temp);
			}

			str_replace('/  /',' ',$retour); 								//au cas où
			unset($devise,$ssdevise,$valeur,$milliers);						//un petit nettoyage avant départ
			return trim($retour);											//on renvoi le tout
		}
}
}