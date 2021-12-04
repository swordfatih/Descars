<?php
    function liste_vehicules() 
    {
        require('./modeles/connect.php');
		
		try {
			$stmt = $pdo->prepare('SELECT * FROM `vehicule` WHERE `etatL`<>"indisponible";');
            $stmt->execute();

            return $stmt->fetchAll();
		} catch( PDOException $e ) {
			echo "Erreur SQL :", $e->getMessage();
		}

		return null;
    }

    function changer_etatL($veh_id, $etatL) {
        require('./modeles/connect.php');
		
		try {
			$stmt = $pdo->prepare('UPDATE `vehicule` SET `etatL`=:etatL WHERE `veh_id`=:veh_id;');
            $stmt->bindParam('etatL', $etatL, PDO::PARAM_STR);
            $stmt->bindParam('veh_id', $veh_id, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll();
		} catch( PDOException $e ) {
			echo "Erreur SQL :", $e->getMessage();
		}

		return null;
    }
    
    function vehicule_by_id($id) 
    {
        require('./modeles/connect.php');
		
		try {
			$stmt = $pdo->prepare('SELECT `veh_id`, `type`, `tarif`, `caract`, `photo`, `etatL` FROM `vehicule` WHERE veh_id=:id;');
            $stmt->bindParam('id', $id, PDO::PARAM_INT);
            $stmt->execute();
            
            $resultat = $stmt->fetchAll();

            if(count($resultat) > 0) 
                return $resultat[0];
		} catch( PDOException $e ) {
			echo "Erreur SQL :", $e->getMessage();
		}

		return null;
    }

    function ajouter_vehicule($data) {
        require('./modeles/connect.php');

		try {
            $etatL = 'disponible';

			$stmt = $pdo->prepare('INSERT INTO `vehicule` (`type`, `tarif`, `photo`, `caract`, `etatL`) VALUES (:typeV, :tarif, :photo, :caract, :etatL);');
			$stmt->bindParam('typeV', $data['type'], PDO::PARAM_STR);
			$stmt->bindParam('tarif', $data['tarif'], PDO::PARAM_INT);
			$stmt->bindParam('photo', $data['photo'], PDO::PARAM_STR);
			$stmt->bindParam('caract', $data['caract'], PDO::PARAM_STR);
			$stmt->bindParam('etatL', $etatL, PDO::PARAM_STR);
			$stmt->execute();

			return 0;
		} catch( PDOException $e ) {
			echo "Erreur SQL :", $e->getMessage();
		}
		
		return "Une erreur est survenue lors de l'ajout.";
    }

    function liberer_vehicule($veh_id) {
        require('./modeles/connect.php');
		
        $etatL = 'disponible';

		try {
			$stmt = $pdo->prepare('UPDATE `vehicule` SET `etatL`=:etatL WHERE `veh_id`=:veh_id;');
            $stmt->bindParam('etatL', $etatL, PDO::PARAM_STR);
            $stmt->bindParam('veh_id', $veh_id, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll();
		} catch( PDOException $e ) {
			echo "Erreur SQL :", $e->getMessage();
		}

		return null;
    }
?>
