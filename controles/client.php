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
        
        $keys = array('email', 'mdp', 'role');
        $data = recuperer_données($keys);

        if(count(array_intersect_key($data, array_flip($keys))) == count($keys))
        {
            $data['mdp'] = hash('sha256', $data['mdp']);
        
            $resultat = authentifier($data);

            if($resultat == "Succès") {
                if(isset($_SESSION['previous'])) {
                    header('Location: ./index.php?controle=' . $_SESSION['previous']['controle'] . '&action=' . $_SESSION['previous']['action']);
                    unset($_SESSION['previous']);
                }   
                else
                    header('Location: ./index.php?controle=client&action=accueil');
            }
        }

        require('./vues/layouts/layout.tpl');
    }

    function inscription() {
        require('./modeles/client.php');

        $client = récupérer_client();

        if($client != null)
            header('Location: ./index.php?controle=client&action=accueil');
    
        $keys = array('nom', 'pseudo', 'email', 'adresseE', 'nomE', 'mdp');
        $data = recuperer_données($keys);

        if(count(array_intersect_key($data, array_flip($keys))) == count($keys))
        {
            $data['mdp'] = hash('sha256', $data['mdp']);

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

    function dashboard() {
        require('./modeles/facture.php');
        require('./modeles/vehicule.php');
        require('./modeles/loueur.php');

        $client = récupérer_client();

        if($client == null)
            header('Location: ./index.php?controle=client&action=accueil');

        $factures = liste_factures_by_id($client['cli_id']); 

        for($i = 0, $count = count($factures); $i < $count; ++$i)
            $factures[$i]['vehicule'] = vehicule_by_id($factures[$i]['veh_id']);

        $est_aussi_loueur = est_loueur($client['cli_id']);

        require('./vues/layouts/layout.tpl');
    }

    function panier() {
        require('./modeles/facture.php');

        if(!isset($_SESSION['client']) || $_SESSION['client']['role'] != 'client') 
            header('Location: ./index.php?controle=client&action=accueil');

        $panier = isset($_SESSION['panier']) && count($_SESSION['panier']) != 0 ? $_SESSION['panier'] : null;  

        $total = 0;
        if($panier != null) {
            foreach($panier as $item) {
                $total += $item['prix'];
            } 

            if(isset($_GET['regler'])) {
                $client = récupérer_client();

                if($client == null) {
                    $_SESSION['previous'] = array('controle' => 'client', 'action' => 'panier&regler');
                    header('Location: ./index.php?controle=client&action=authentification');
                }

                foreach($panier as $item) {
                    facturation($client['cli_id'], $item['vehicule']['veh_id'], $item['debut'], $item['fin'], $item['prix']);
                } 

                unset($_SESSION['panier']);
                $_SESSION['panier'] = null;
                $panier = null;
            }
        }

        require('./vues/layouts/layout.tpl');
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
    
    return array('accueil', 'authentification', 'inscription', 'deconnection', 'dashboard', 'panier');
?>