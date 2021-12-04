<?php

function changer() {
    require('./modeles/loueur.php');

    if(isset($_SESSION['client'])) {
        if($_SESSION['client']['role'] == 'loueur') 
            $_SESSION['client']['role'] = 'client';
        else if(est_loueur($_SESSION['client']['cli_id']))
            $_SESSION['client']['role'] = 'loueur';
    }

    header('Location: ./index.php?controle=client&action=accueil');
}

function changer_revision() {
    require('./modeles/vehicule.php');
    require('./modeles/facture.php');

    if(!isset($_SESSION['client']) || $_SESSION['client']['role'] != 'loueur')
        header('Location: ./index.php?controle=client&action=accueil');

    if(isset($_GET['veh_id'])) {
        $vehicule = vehicule_by_id($_GET['veh_id']);

        if($vehicule != null) {
            changer_etatL($vehicule['veh_id'], $vehicule['etatL'] == 'en_revision' ? 'disponible' : 'en_revision');

            if($vehicule['etatL'] != 'disponible' && $vehicule['etatL'] != 'en_revision' && $vehicule['etatL'] != 'indisponible') {
                $location = trouver_location_en_cours($vehicule['veh_id']);
                changer_etatR($location['fac_id'], 1);
            }
        }
    }

    header('Location: ./index.php?controle=loueur&action=gestion');
}

function supprimer_vehicule() {
    if(!$_SESSION['client'] || $_SESSION['client']['role'] != 'loueur') {
        header('Location: ./index.php?controle=client&action=accueil');
    }

    require('./modeles/vehicule.php');
    require('./modeles/facture.php');

    if(isset($_GET['veh_id'])) {
        $vehicule = vehicule_by_id($_GET['veh_id']);

        if($vehicule != null) {
            changer_etatL($_GET['veh_id'], 'indisponible');

            if($vehicule['etatL'] != 'disponible' && $vehicule['etatL'] != 'en_revision' && $vehicule['etatL'] != 'indisponible') {
                $location = trouver_location_en_cours($vehicule['veh_id']);
                changer_etatR($location['fac_id'], 1);
            }
        }
    }

    header('Location: ./index.php?controle=loueur&action=gestion');
}

function gestion() {
    require('./modeles/vehicule.php');

    if(!isset($_SESSION['client']) || $_SESSION['client']['role'] != 'loueur') 
        header('Location: ./index.php?controle=client&action=accueil');

    if(count($_POST) > 0) {
        $keys = array('type', 'tarif', 'caract');
        $data = recuperer_données($keys);

        if(count(array_intersect_key($data, array_flip($keys))) == count($keys) && isset($_FILES['photo']))
        {
            $uploaddir = './vues/assets/vehicules/';
            $uploadfile = $uploaddir . basename($_FILES['photo']['name']);
            move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile);

            $data['photo'] = basename($_FILES['photo']['name']);
            
            $resultat = ajouter_vehicule($data);
            
            if($resultat == 0)
                header('Location: ./index.php?controle=loueur&action=gestion');
        }

        $resultat = "Formulaire incomplet";
        $resultat .= "<style> #res { color: red; }</style>";
    } 

    require('./modeles/facture.php');
    require('./modeles/client.php');

    $vehicules = liste_vehicules();
    $locations = liste_locations();

    for($i = 0, $count = count($locations); $i < $count; ++$i) {
        $locations[$i]['vehicule'] = vehicule_by_id($locations[$i]['veh_id']);
        $locations[$i]['client'] = client_by_id($locations[$i]['cli_id']);
    }

    require('./vues/layouts/layout.tpl');
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

return array('changer', 'gestion');

?>