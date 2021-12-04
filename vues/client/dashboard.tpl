<h1>Tableau de bord</h1>

<?php $ligne = '<tr>
        <td><img src="./vues/assets/vehicules/%s"/></td>
        <td>%s</td>
        <td>%s</td>
        <td>%s</td>
        <td>%d€</td>
        <td>%s</td>
    </tr>';

    if(!isset($factures) || count($factures) == 0) {
        echo "<p>Vous n'avez loué aucun véhicule.</p>";
        echo '<a class="button" href="./index.php?controle=vehicule&action=parcourir">Parcourir les véhicules</a>';
        return;
    }
?>

<table class="liste" cellspacing=0>
    <tr>  
        <th>Véhicule</th>
        <th>Modèle</th>
        <th>Début</th>
        <th>Fin</th>
        <th>Prix total</th>
        <th>Etat</th>
    </tr>

    <?php 
        foreach($factures as $facture) {
            echo sprintf($ligne, 
                $facture['vehicule']['photo'],
                $facture['vehicule']['type'], 
                $facture['dateD'], 
                $facture['dateF'] == null ? 'Mensuel' : $facture['dateF'], 
                $facture['valeur'], 
                $facture['etatR'] ? 'Rendu' : '<a class="button" href="./index.php?controle=facture&action=regler&fac_id=' . $facture['fac_id'] . '">Régler</a>');
        } 
    ?>
</table>

<?php if($est_aussi_loueur)
    echo '<a class="button" href="./index.php?controle=loueur&action=changer">Se connecter en tant que loueur</a>';
?>