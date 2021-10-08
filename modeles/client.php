<?php
    function authentifier($data) 
	{
		require('./modeles/connect.php');
		
		$stmt = $pdo->prepare('SELECT * FROM `client` WHERE email=:email AND mdp=:mdp;');
		$stmt->bindParam('email', $data['email'], PDO::PARAM_STR);
		$stmt->bindParam('mdp', $data['mdp'], PDO::PARAM_STR);
		$stmt->execute();

		$resultat = $stmt->fetchAll();
	
		if(count($resultat) > 0) 
		{
			$_SESSION["client"] = result_to_client($resultat);
			return true;
		}
		
		return false;
	}

	function inscrire($data) 
	{
		require('./modeles/connect.php');

		try {
			if(client_by_email($data['email']) != null)
				return "Un compte a déjà été crée avec l'email donné.";

			$stmt = $pdo->prepare('INSERT INTO `client` (`pseudo`, `nom`, `adresse`, `email`, `mdp`) VALUES (:pseudo, :nom, :adresse, :email, :mdp);');
			$stmt->bindParam('pseudo', $data['pseudo'], PDO::PARAM_STR);
			$stmt->bindParam('nom', $data['nom'], PDO::PARAM_STR);
			$stmt->bindParam('adresse', $data['adresse'], PDO::PARAM_STR);
			$stmt->bindParam('email', $data['email'], PDO::PARAM_STR);
			$stmt->bindParam('mdp', $data['mdp'], PDO::PARAM_STR);

			$stmt->execute();

			$_SESSION["client"] = client_by_email($data['email']);

			return 0;
		} catch( PDOException $e ) {
			echo "Erreur SQL :", $e->getMessage();
		}
		
		return 'Une erreur est survenue lors de votre inscription.';
	}

	function result_to_client($resultat) 
    {
        $client = array();
                
        $client["cli_id"] = $resultat[0]['cli_id'];
        $client["nom"] = $resultat[0]['nom'];
        $client["adresse"] = $resultat[0]['adresse'];
        $client["pseudo"] = $resultat[0]['pseudo'];
        $client["email"] = $resultat[0]['email'];
        
        return $client;
    }

	function client_by_email($email) 
    {
        require('./modeles/connect.php');
		
		try {
			$stmt = $pdo->prepare('SELECT `cli_id`, `nom`, `pseudo`, `adresse`, `email` FROM `client` WHERE email=:email;');
            $stmt->bindParam('email', $email, PDO::PARAM_STR);
            $stmt->execute();
            
            $resultat = $stmt->fetchAll();
            
            if(count($resultat) > 0) 
                return result_to_client($resultat);
		} catch( PDOException $e ) {
			echo "Erreur SQL :", $e->getMessage();
		}

		return null;
    }
?>