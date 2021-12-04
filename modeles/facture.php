 <?php
    function facturation($cli_id, $veh_id, $debut, $fin, $prix) 
    {
        require('./modeles/connect.php');

        try {
            $dated = $debut->format('Y-m-d');
            $datef = $fin != null ? $fin->format('Y-m-d') : null;

            $stmt = $pdo->prepare('INSERT INTO `facture` (`cli_id`, `veh_id`, `dateD`, `dateF`, `valeur`, `etatR`) VALUES (:cli_id, :veh_id, :dateD, :dateF, :valeur, 0);');
            $stmt->bindParam('cli_id', $cli_id, PDO::PARAM_INT);
            $stmt->bindParam('veh_id', $veh_id, PDO::PARAM_INT);
            $stmt->bindParam('dateD', $dated, PDO::PARAM_STR);
            $stmt->bindParam('dateF', $datef, PDO::PARAM_STR);
            $stmt->bindParam('valeur', $prix, PDO::PARAM_STR);

            $stmt->execute();

            $stmt = $pdo->prepare('UPDATE `vehicule` SET `etatL`=:cli_id WHERE `veh_id` = :veh_id;');
            $stmt->bindParam('cli_id', $cli_id, PDO::PARAM_INT);
            $stmt->bindParam('veh_id', $veh_id, PDO::PARAM_INT);

            $stmt->execute();

            return 0;
        } catch( PDOException $e ) {
            echo "Erreur SQL :", $e->getMessage();
        }
        
        return 'Une erreur est survenue lors de la facturation.';
    }

    function liste_factures_by_id($cli_id) {
        require('./modeles/connect.php');
		
		try {
			$stmt = $pdo->prepare('SELECT * FROM `facture` WHERE `cli_id`=:cli_id;');
            $stmt->bindParam('cli_id', $cli_id, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll();
		} catch( PDOException $e ) {
			echo "Erreur SQL :", $e->getMessage();
		}

		return null;
    }

    function liste_locations() {
        require('./modeles/connect.php');
		
		try {
			$stmt = $pdo->prepare('SELECT * FROM `facture` WHERE `etatR`=0;');
            $stmt->execute();
            
            return $stmt->fetchAll();
		} catch( PDOException $e ) {
			echo "Erreur SQL :", $e->getMessage();
		}

		return null;
    }

    function facture_by_id($fac_id) {
        require('./modeles/connect.php');
		
		try {
			$stmt = $pdo->prepare('SELECT * FROM `facture` WHERE `fac_id`=:fac_id;');
            $stmt->bindParam('fac_id', $fac_id, PDO::PARAM_INT);
            $stmt->execute();
            
            $resultat = $stmt->fetchAll();

            if(count($resultat) > 0) 
                return $resultat[0];
		} catch( PDOException $e ) {
			echo "Erreur SQL :", $e->getMessage();
		}

		return null;
    }

    function changer_etatR($fac_id, $etatR) {
        require('./modeles/connect.php');
		
		try {
			$stmt = $pdo->prepare('UPDATE `facture` SET `etatR`=:etatR WHERE `fac_id`=:fac_id;');
            $stmt->bindParam('etatR', $etatR, PDO::PARAM_INT);
            $stmt->bindParam('fac_id', $fac_id, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll();
		} catch( PDOException $e ) {
			echo "Erreur SQL :", $e->getMessage();
		}

		return null;
    }

    function trouver_location_en_cours($veh_id) {
        require('./modeles/connect.php');
		
		try {
			$stmt = $pdo->prepare('SELECT * FROM `facture` WHERE `veh_id`=:veh_id AND `etatR`=0');
            $stmt->bindParam('veh_id', $veh_id, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll()[0];
		} catch( PDOException $e ) {
			echo "Erreur SQL :", $e->getMessage();
		}

		return null;
    }
?>