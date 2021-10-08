<?php
    function liste_vehicules() 
    {
        require('./modeles/connect.php');
		
		try {
			$stmt = $pdo->prepare('SELECT `veh_id` FROM `vehicule`;');
            $stmt->execute();
            
            $resultat = $stmt->fetchAll();
            
            $identifiants = array();

            foreach($resultat as $ligne) 
                array_push($identifiants, $ligne['veh_id']);

            return $identifiants;
		} catch( PDOException $e ) {
			echo "Erreur SQL :", $e->getMessage();
		}

		return null;
    }

    function vehicule_by_id($id) 
    {
        require('./modeles/connect.php');
		
		try {
			$stmt = $pdo->prepare('SELECT `veh_id`, `type`, `nb`, `caract`, `photo`, `etatL` FROM `vehicule` WHERE veh_id=:id;');
            $stmt->bindParam('id', $id, PDO::PARAM_INT);
            $stmt->execute();
            
            $resultat = $stmt->fetchAll();

            if(count($resultat) > 0) 
                return result_to_vehicule($resultat);
		} catch( PDOException $e ) {
			echo "Erreur SQL :", $e->getMessage();
		}

		return null;
    }

    function result_to_vehicule($resultat) 
    {
        $vehicule = array();
                
        $vehicule["veh_id"] = $resultat[0]['veh_id'];
        $vehicule["type"] = $resultat[0]['type'];
        $vehicule["nb"] = $resultat[0]['nb'];
        $vehicule["caract"] = $resultat[0]['caract'];
        $vehicule["photo"] = $resultat[0]['photo'];
        $vehicule["etatL"] = $resultat[0]['etatL'] == 1 ? true : false;
        
        return $vehicule;
    }
?>
