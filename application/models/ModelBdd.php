<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelBdd extends CI_Model
{
	public function create_bdd()
	{

		$sql = "CREATE DATABASE IF NOT EXISTS pharmacie";

		$sq = "USE pharmacie";


		$sql1 = "CREATE TABLE IF NOT EXISTS `consultation` (
				  `codeConsultation` int(11) NOT NULL AUTO_INCREMENT,
				  `dateCons` date NOT NULL,
				  `motif` varchar(255) NOT NULL,
				  `anamnese` text NOT NULL,
				  `suspicion` varchar(255) NOT NULL DEFAULT '',
				  `examComplem` varchar(255) NOT NULL DEFAULT '',
				  `codePatient` int(11) NOT NULL DEFAULT '0',
				  `codeParam` int(11) NOT NULL DEFAULT '0',
				  `codeDecision` int(11) NOT NULL DEFAULT '1',
				  `codeTraitement` int(11) DEFAULT NULL,
				  PRIMARY KEY (`codeConsultation`)
				) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;";

		$sql2 = "CREATE TABLE IF NOT EXISTS `decision` (
				  `codeDecision` int(11) NOT NULL AUTO_INCREMENT,
				  `decisionDoc` varchar(50) NOT NULL,
				  PRIMARY KEY (`codeDecision`)
				) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

				";

		$sql3 = "CREATE TABLE IF NOT EXISTS `espece` (
				  `codeEspece` int(11) NOT NULL AUTO_INCREMENT,
				  `libelle_espece` varchar(30) CHARACTER SET utf8 NOT NULL,
				  PRIMARY KEY (`codeEspece`)
				) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
				";
		$sql4 = "CREATE TABLE IF NOT EXISTS `facture_commande` (
				  `numcom` int(11) NOT NULL AUTO_INCREMENT,
				  `codeFrs` int(11) NOT NULL DEFAULT '0',
				  `dateCom` date NOT NULL,
				  PRIMARY KEY (`numcom`)
				) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
				";
		$sql5 = "CREATE TABLE IF NOT EXISTS `facture_soin` (
				  `numfactureSoin` int(11) NOT NULL AUTO_INCREMENT,
				  `codePatient` int(11) NOT NULL,
				  `dateSoin` date NOT NULL,
				  PRIMARY KEY (`numfactureSoin`)
				) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;


				";
		$sql6 = "CREATE TABLE IF NOT EXISTS `facture_traitement` (
				  `numTraitement` int(11) NOT NULL AUTO_INCREMENT,
				  `codePatient` int(11) NOT NULL DEFAULT '0',
				  `dateTraitement` date NOT NULL,
				  `numConsult` int(11) DEFAULT NULL,
				  PRIMARY KEY (`numTraitement`)
				) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
				";
		$sql7 = "CREATE TABLE IF NOT EXISTS `fournisseur` (
				  `codeFrs` int(11) NOT NULL AUTO_INCREMENT,
				  `nomFrs` varchar(50) DEFAULT NULL,
				  `responsable` varchar(50) DEFAULT NULL,
				  `contact_frs` varchar(50) DEFAULT NULL,
				  `adresse_frs` varchar(50) DEFAULT NULL,
				  `email_frs` varchar(50) DEFAULT NULL,
				  PRIMARY KEY (`codeFrs`)
				) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
				";
		$sql8 = "CREATE TABLE IF NOT EXISTS `hospitalisation` (
				  `codehospitalisation` int(11) NOT NULL AUTO_INCREMENT,
				  `codePatient` int(11) NOT NULL,
				  `dateDebut` date DEFAULT NULL,
				  `dateFin` date DEFAULT NULL,
				  PRIMARY KEY (`codehospitalisation`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8;
				";
		$sql9 = "CREATE TABLE IF NOT EXISTS `lignecomfrs` (
				  `numcom` int(11) DEFAULT NULL,
				  `codeMed` int(11) DEFAULT NULL,
				  `qte` int(11) DEFAULT NULL
				) ENGINE=InnoDB DEFAULT CHARSET=utf8;
				";
		$sql10 = "CREATE TABLE IF NOT EXISTS `ligne_soin` (
				  `numfactureSoin` int(11) DEFAULT NULL,
				  `codeSoin` int(11) DEFAULT NULL
				) ENGINE=InnoDB DEFAULT CHARSET=utf8;


				";
		$sql11 = "CREATE TABLE IF NOT EXISTS `ligne_traitement` (
				  `numTraitement` int(11) NOT NULL,
				  `codeMed` int(11) DEFAULT NULL,
				  `qte` float DEFAULT NULL
				) ENGINE=InnoDB DEFAULT CHARSET=utf8;


				";
		$sql12 = "CREATE TABLE IF NOT EXISTS `ligne_vaccin` (
				  `codeVaccin` int(11) DEFAULT NULL,
				  `codemed` int(11) DEFAULT NULL,
				  `qte` float DEFAULT NULL
				) ENGINE=InnoDB DEFAULT CHARSET=utf8;


				";
		$sql13 = "CREATE TABLE IF NOT EXISTS `medicament` (
				  `codeMed` int(11) NOT NULL AUTO_INCREMENT,
				  `libelleMed` varchar(255) CHARACTER SET utf8 NOT NULL,
				  `unite` varchar(40) NOT NULL,
				  `description` text NOT NULL,
				  `presentationGros` varchar(50) NOT NULL DEFAULT '0',
				  `puDetail` int(11) DEFAULT NULL,
				  `datePeremption` date NOT NULL,
				  `codeTrait` int(11) DEFAULT NULL,
				  `stock` double NOT NULL DEFAULT '0',
				  `presentation` varchar(50) DEFAULT '',
				  `parPresentation` smallint(6) DEFAULT NULL,
				  `prixPresentation` int(11) DEFAULT NULL,
				  PRIMARY KEY (`codeMed`)
				) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;


				";
		$sql14 = "CREATE TABLE IF NOT EXISTS `parametre` (
				  `codeParametre` int(11) NOT NULL AUTO_INCREMENT,
				  `freqCard` double NOT NULL DEFAULT '0',
				  `freqResp` double NOT NULL DEFAULT '0',
				  `TRC` varchar(10) NOT NULL DEFAULT '0',
				  `temperature` double NOT NULL DEFAULT '0',
				  `poids` double NOT NULL DEFAULT '0',
				  `taille` int(11) DEFAULT '0',
				  PRIMARY KEY (`codeParametre`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8;


				";
		$sql15 = "CREATE TABLE IF NOT EXISTS `patient` (
				  `codePatient` int(11) NOT NULL AUTO_INCREMENT,
				  `nomPatient` varchar(100) CHARACTER SET utf8 NOT NULL,
				  `dateNais` date DEFAULT NULL,
				  `age` decimal(10,0) DEFAULT NULL,
				  `codeSexe` mediumint(9) NOT NULL DEFAULT '0',
				  `codeRace` mediumint(9) NOT NULL DEFAULT '0',
				  `codeProprio` int(11) NOT NULL DEFAULT '0',
				  `couleur` varchar(50) NOT NULL DEFAULT '0',
				  `variete` varchar(50) NOT NULL DEFAULT '0',
				  `codeEspece` mediumint(9) NOT NULL DEFAULT '0',
				  `img_patiencreated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
				  `description` text,
				  PRIMARY KEY (`codePatient`)
				) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;


				";
		$sql16 = "CREATE TABLE IF NOT EXISTS `payement_client` (
				  `codeComCli` int(11) NOT NULL AUTO_INCREMENT,
				  `payee` int(11) DEFAULT '0',
				  `numFact` int(11) NOT NULL,
				  `type` varchar(50) DEFAULT NULL,
				  `net` int(11) DEFAULT NULL,
				  `codeProprio` int(11) DEFAULT NULL,
				  `date` date DEFAULT NULL,
				  PRIMARY KEY (`codeComCli`)
				) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;


				";
		$sql17 = "CREATE TABLE IF NOT EXISTS `payement_frs` (
				  `codePayement` int(11) NOT NULL AUTO_INCREMENT,
				  `payee` int(11) NOT NULL DEFAULT '0',
				  `net` int(11) NOT NULL,
				  `codeCom` int(11) NOT NULL DEFAULT '0',
				  `dateFin` date DEFAULT NULL,
				  PRIMARY KEY (`codePayement`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8;


				";
		$sql18 = "CREATE TABLE IF NOT EXISTS `proprietaire` (
				  `codeProprio` int(11) NOT NULL AUTO_INCREMENT,
				  `nomProprio` varchar(255) CHARACTER SET utf8 NOT NULL,
				  `adresseProprio` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
				  `contactProprio` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
				  `emailProprio` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
				  `status` varchar(50) DEFAULT 'Non remisé',
				  `organisation` varchar(50) DEFAULT '-',
				  PRIMARY KEY (`codeProprio`)
				) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;


				";
		$sql19 = "CREATE TABLE IF NOT EXISTS `race` (
				  `codeRace` int(11) NOT NULL AUTO_INCREMENT,
				  `nom_race` varchar(255) CHARACTER SET utf8 NOT NULL,
				  `codeEspece` int(11) DEFAULT NULL,
				  PRIMARY KEY (`codeRace`)
				) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;


				";
		$sql20 = "CREATE TABLE IF NOT EXISTS `rappel` (
				  `codeRappel` int(11) NOT NULL AUTO_INCREMENT,
				  `codePatient` int(11) NOT NULL,
				  `codeRappeller` int(11) NOT NULL,
				  `dateRappel` date NOT NULL,
				  `type` varchar(50) DEFAULT NULL,
				  PRIMARY KEY (`codeRappel`)
				) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


				";
		$sql21 = "CREATE TABLE IF NOT EXISTS `sexe` (
				  `codeSexe` int(11) unsigned NOT NULL AUTO_INCREMENT,
				  `libelle_sexe` varchar(50) CHARACTER SET utf8 NOT NULL,
				  PRIMARY KEY (`codeSexe`)
				) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;


				";
		$sql25 = "CREATE TABLE IF NOT EXISTS `soin` (
				  `codeSoin` int(11) NOT NULL AUTO_INCREMENT,
				  `rubrique` varchar(50) DEFAULT NULL,
				  `prix` int(11) DEFAULT NULL,
				  `description` text,
				  `codeEspece` int(11) DEFAULT NULL,
				  PRIMARY KEY (`codeSoin`)
				) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=utf8;
				";
		$sql22 = "CREATE TABLE IF NOT EXISTS `traitement` (
				  `codeTrait` int(11) NOT NULL AUTO_INCREMENT,
				  `libelleTrait` varchar(255) CHARACTER SET utf8 NOT NULL,
				  PRIMARY KEY (`codeTrait`)
				) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;


				";
		$sql23 = "CREATE TABLE IF NOT EXISTS `user` (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `pseudo` varchar(50) NOT NULL,
				  `mdp` varchar(255) NOT NULL,
				  `type` varchar(20) NOT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;



				";
		$sql24 = "CREATE TABLE IF NOT EXISTS `vaccin` (
				  `codeVaccin` int(11) NOT NULL AUTO_INCREMENT,
				  `codePatient` int(11) NOT NULL DEFAULT '0',
				  `dateVaccin` date NOT NULL,
				  PRIMARY KEY (`codeVaccin`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8;
				";

						$sql27 = "INSERT into sexe VALUES(1 , 'mâle castré') ,  (3 , 'mâle non-castré') , (1 , 'femelle sterilisé') , (1 , 'femelle non sterilisé')"; 

		
		return (
			$this->db->query($sql) && $this->db->query($sq) &&
			$this->db->query($sql1) && $this->db->query($sql2) &&
			$this->db->query($sql3) && $this->db->query($sql4) &&
			$this->db->query($sql5) && $this->db->query($sql6) &&
			$this->db->query($sql7) && $this->db->query($sql8) &&
			$this->db->query($sql9) && $this->db->query($sql10) &&
			$this->db->query($sql11) && $this->db->query($sql12) &&
			$this->db->query($sql13) && $this->db->query($sql14) &&
			$this->db->query($sql15) && $this->db->query($sql16) &&
			$this->db->query($sql17) && $this->db->query($sql18) &&
			$this->db->query($sql19) && $this->db->query($sql20) &&
			$this->db->query($sql21) && $this->db->query($sql22) &&
			$this->db->query($sql23) && $this->db->query($sql24) &&
			$this->db->query($sql25) 
		);
		
}
}