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
			if($data["role"] == 'loueur') {
				require('./modeles/loueur.php');

				if(!est_loueur($resultat[0]['cli_id']))
					return "Vous n'êtes pas un loueur.";
			}

			$_SESSION["client"] = $resultat[0];
			$_SESSION["client"]["role"] = $data['role'];

			return "Succès";
		}

		return "Identifiants invalides.";
	}

	function inscrire($data) 
	{
		require('./modeles/connect.php');

		try {
			if(client_by_email($data['email']) != null)
				return "Un compte a déjà été crée avec l'email donné.";

			$stmt = $pdo->prepare('INSERT INTO `client` (`pseudo`, `nom`, `adresseE`, `nomE`, `email`, `mdp`) VALUES (:pseudo, :nom, :adresseE, :nomE, :email, :mdp);');
			$stmt->bindParam('pseudo', $data['pseudo'], PDO::PARAM_STR);
			$stmt->bindParam('nom', $data['nom'], PDO::PARAM_STR);
			$stmt->bindParam('adresseE', $data['adresseE'], PDO::PARAM_STR);
			$stmt->bindParam('nomE', $data['nomE'], PDO::PARAM_STR);
			$stmt->bindParam('email', $data['email'], PDO::PARAM_STR);
			$stmt->bindParam('mdp', $data['mdp'], PDO::PARAM_STR);

			$stmt->execute();

			$_SESSION["client"] = client_by_email($data['email']);
			$_SESSION["client"]["role"] = "client";

			return 0;
		} catch( PDOException $e ) {
			echo "Erreur SQL :", $e->getMessage();
		}
		
		return 'Une erreur est survenue lors de votre inscription.';
	}

	function client_by_email($email) 
    {
        require('./modeles/connect.php');
		
		try {
			$stmt = $pdo->prepare('SELECT `cli_id`, `nom`, `pseudo`, `email`, `nomE`, `adresseE` FROM `client` WHERE email=:email;');
            $stmt->bindParam('email', $email, PDO::PARAM_STR);
            $stmt->execute();
            
            $resultat = $stmt->fetchAll();
            
            if(count($resultat) > 0) 
                return $resultat[0];
		} catch( PDOException $e ) {
			echo "Erreur SQL :", $e->getMessage();
		}

		return null;
    }

	function client_by_id($cli_id) 
    {
        require('./modeles/connect.php');
		
		try {
			$stmt = $pdo->prepare('SELECT `cli_id`, `nom`, `pseudo`, `email`, `nomE`, `adresseE` FROM `client` WHERE cli_id=:cli_id;');
            $stmt->bindParam('cli_id', $cli_id, PDO::PARAM_INT);
            $stmt->execute();
            
            $resultat = $stmt->fetchAll();
            
            if(count($resultat) > 0) 
                return $resultat[0];
		} catch( PDOException $e ) {
			echo "Erreur SQL :", $e->getMessage();
		}

		return null;
    }
?>