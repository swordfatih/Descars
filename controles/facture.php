<?php

function regler() {
    if(!$_SESSION['client']) {
        $_SESSION['previous'] = array('controle' => 'facture', 'action' => 'regler&id=' . $_GET['fac_id']);
        header('Location: ./index.php?controle=client&action=authentification');
    }

    require('./modeles/facture.php');
    require('./modeles/vehicule.php');

    if(isset($_GET['fac_id'])) {
        $fac_id = $_GET['fac_id'];

        changer_etatR($fac_id, 1);

        $veh_id = facture_by_id($fac_id)['veh_id'];

        header('Location: ./index.php?controle=vehicule&action=liberer&veh_id=' . $veh_id);
        die('after');
    }

    header('Location: ./index.php?controle=client&action=dashboard');
}

return array('regler');

?>