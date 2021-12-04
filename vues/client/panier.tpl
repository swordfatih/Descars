<div>
    <h1>Votre panier</h1>
</div>

<?php $product = '
    <tr>
        <td><img src="./vues/assets/vehicules/%s"/></td>
        <td>%s</td>
        <td>%d€ par jour</td>
        <td>%s</td>
        <td>%s</td>
        <td>%d€</td>
        <td><a href="./index.php?controle=vehicule&action=retirer&veh_id=%s">❌</a></td>
    </tr>';

    if(!isset($panier)) {
        echo '<p>Le panier est vide.</p>';
        echo '<a class="button" href="./index.php?controle=vehicule&action=parcourir">Parcourir les véhicules</a>';
        return;
    }
?>

<table class="liste" cellspacing=0>
    <tr>
        <th>Véhicule</th>
        <th>Modèle</th>
        <th>Tarif</th>
        <th>Début</th>
        <th>Fin</th>
        <th>Prix total</th>
        <th>Action</th>
    </tr>

    <?php 
        foreach($panier as $item) {
            echo sprintf($product, 
                $item['vehicule']['photo'], 
                $item['vehicule']['type'], 
                $item['vehicule']['tarif'], 
                $item['debut']->format('d-m-Y'), 
                $item['fin'] == null ? 'Mensuel' : $item['fin']->format('d-m-Y'), 
                $item['prix'], $item['vehicule']['veh_id']);
        } 
    ?>
</table>

<form action="./index.php?controle=client&action=panier&regler" method="post">
    <h1>Prix total : <?php echo $total; ?>€</h1>
    <input type="submit" value="Passer la commande" />
</form>