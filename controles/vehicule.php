<?php
    function parcourir()
    {
        require('./modeles/vehicule.php');

        $vehicules = liste_vehicules();
        
        require('./vues/layouts/layout.tpl');
    }

    function visualiser()
    {
        require('./modeles/vehicule.php');

        if(!isset($_GET['id']))
            header('Location: ./index.php?controle=client&action=accueil');

        if(!isset($_SESSION['panier'])) 
            $_SESSION['panier'] = array();

        $id = $_GET['id'];
        $vehicule = vehicule_by_id($id);

        $dans_panier = isset($_SESSION['panier'][$vehicule['veh_id']]);

        if(isset($_POST['ajout'])) {
            $keys = array('debut', 'fin');
            $data = recuperer_données($keys);
    
            if(count(array_intersect_key($data, array_flip($keys))) >= 1) {
                $debut = new DateTime($data['debut']);
                $fin = isset($data['fin']) ? new DateTime($data['fin']) : null;

                $prix = calculer_prix($debut, $fin, $vehicule['tarif']);

                if($prix != -1) {
                    $_SESSION['panier'][$vehicule['veh_id']] = array();
                    $panier = &$_SESSION['panier'][$vehicule['veh_id']];

                    $panier['vehicule'] = $vehicule;
                    $panier['debut'] = $debut;
                    $panier['fin'] = $fin;
                    $panier['prix'] = $prix;

                    header('Location: ./index.php?controle=vehicule&action=parcourir');   
                } 

                $resultat = "Les données sont invalides";
            }
        } else if(isset($_POST['retrait']) && $dans_panier) {
            $_SESSION['previous'] = array('controle' => 'vehicule', 'action' => 'parcourir');
            header('Location: ./index.php?controle=vehicule&action=retirer&veh_id=' . $vehicule['veh_id']);
        }

        $est_client = isset($_SESSION['client']) && $_SESSION['client']['role'] == 'client';
        $date = date('Y-m-d', strtotime('+1 day'));

        require('./vues/layouts/layout.tpl');
    }

    function retirer() {
        unset($_SESSION['panier'][$_GET['veh_id']]);

        if(isset($_SESSION['previous'])) {
            unset($_SESSION['previous']);
            header('Location: ./index.php?controle=' . $_SESSION['previous']['controle'] . '&action=' . $_SESSION['previous']['action']);
        }   
        else
            header('Location: ./index.php?controle=client&action=panier');
    }

    function liberer() {
        if(!$_SESSION['client']) {
            $_SESSION['previous'] = array('controle' => 'vehicule', 'action' => 'liberer&id=' . $_GET['veh_id']);
            header('Location: ./index.php?controle=client&action=authentification');
        }

        require('./modeles/vehicule.php');

        if(isset($_GET['veh_id'])) {
            liberer_vehicule($_GET['veh_id']);
        }

        header('Location: ./index.php?controle=client&action=dashboard');
    }

    function recuperer_données($keys) {
        $data = array();

        foreach($keys as $key) 
            if(isset($_POST[$key])) 
                if($_POST[$key] != '')
                    $data[$key] = $_POST[$key];

        return $data;
    }

    function récupérer_client() {
        return isset($_SESSION["client"]) ? $_SESSION["client"] : null; 
    };

    function calculer_prix($debut, $fin, $tarif) {
        if($debut < new DateTime())
            $resultat = -1;
        else if($fin != null && $fin < $debut)
            $resultat = -1;
        
        if($fin == null) {
            $fin = clone $debut;
            $fin->add(new DateInterval('P1M'));
        }  
       
        return $fin->diff($debut)->format('%a') * $tarif;
    }

    return array('parcourir', 'visualiser', 'retirer', 'liberer');
?>