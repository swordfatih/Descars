<?php
    function parcourir()
    {
        require('./modeles/vehicule.php');

        $identifiants = liste_vehicules();
        $vehicules = array();

        foreach($identifiants as $id)
            array_push($vehicules, vehicule_by_id($id));

        require('./vues/layouts/layout.tpl');
    }

    return array('parcourir');
?>