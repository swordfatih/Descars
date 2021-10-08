<?php
    function accueil() {
        $client = récupérer_client();

        require('./vues/layouts/layout.tpl');
    }

    function authentification() {
        require('./modeles/client.php');

        $client = récupérer_client();

        if($client != null)
            header('Location: ./index.php?controle=client&action=accueil');
    
        $keys = array('email', 'mdp');
        $data = recuperer_données($keys);
    
        if(count($data) == count($keys))
        {
            if(authentifier($data))
                header('Location: ./index.php?controle=client&action=accueil');

            $resultat = "<style> #res { color: red; }</style>Identifiants invalides.";
        }

        require('./vues/layouts/layout.tpl');
    }

    function inscription() {
        require('./modeles/client.php');

        $client = récupérer_client();

        if($client != null)
            header('Location: ./index.php?controle=client&action=accueil');
    
        $keys = array('nom', 'pseudo', 'email', 'adresse', 'mdp');
        $data = recuperer_données($keys);

        if(count($data) == count($keys))
        {
            $resultat = inscrire($data);

            if($resultat == 0)
                header('Location: ./index.php?controle=client&action=accueil');

            $resultat .= "<style> #res { color: red; }</style>";
        }

        require('./vues/layouts/layout.tpl');
    }

    function deconnection() 
	{
        session_destroy();
        header('Location: ./index.php?controle=client&action=accueil');
	}

    function récupérer_client() {
        return isset($_SESSION["client"]) ? $_SESSION["client"] : null; 
    }

    function recuperer_données($keys) {
        $data = array();

        foreach($keys as $key) 
            if(isset($_POST[$key])) {
                if($_POST[$key] == '')
                    echo '<style>#' . $key . '{ background-color: #FF7F7F; }</style>';
                else
                    $data[$key] = $_POST[$key];
            }	

        return $data;
    }
    
    return array('accueil', 'authentification', 'inscription', 'deconnection');
?>