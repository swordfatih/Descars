<?php 
    session_start();

    if (isset($_GET['controle']) && isset($_GET['action'])) {
 	    $controle = $_GET['controle'];
	    $action = $_GET['action'];
	}
    else { 
	    $controle = "client";
	    $action = "accueil";
	}

	$path = './controles/' . $controle . '.php';

	if (!file_exists($path)) 
		header('Location: ./index.php?controle=erreurs&action=indisponible');

    $actions = require($path); 
		
	if(!in_array($action, $actions))
        header('Location: ./index.php?controle=erreurs&action=indisponible');	

    $action(); 
?>