<h1>Liste des véhicules en stock</h1>

<?php $ligne_vehicule = '<tr>
        <td><img src="./vues/assets/vehicules/%s"/></td>
        <td>%s</td>
        <td>%d€ par jour</td>
        <td>%s</td>
        <td>%s</td>
        <td><a href="./index.php?controle=loueur&action=changer_revision&veh_id=%s">%s</a><br>
        <a href="./index.php?controle=loueur&action=supprimer_vehicule&veh_id=%s">Supprimer</a></td>
    </tr>';
    
    if(!isset($vehicules) || count($vehicules) == 0) {
        echo "<p>Il n'y a pas de véhicule en stock, ajoutez-en.</p>";
    } else {
?>

<table class="liste" cellspacing=0>
    <tr>  
        <th>Véhicule</th>
        <th>Modèle</th>
        <th>Tarif</th>
        <th>Etat</th>
        <th>Caractéristiques</th>
        <th>Action</th>
    </tr>

    <?php 
        foreach($vehicules as $vehicule) {
            $caract_data = json_decode($vehicule['caract']);
            $caract = "";

            foreach($caract_data as $key => $value) {
                $caract .= $key . ' : ' . $value . '<br>';
            }

            echo sprintf($ligne_vehicule, 
                $vehicule['photo'], 
                $vehicule['type'], 
                $vehicule['tarif'], 
                $vehicule['etatL'] == 'disponible' ? 'Disponible' : ($vehicule['etatL'] == 'en_revision' ? 'En révision' : ('Loué par ' . client_by_id($vehicule['etatL'])['pseudo'])),
                $caract, 
                $vehicule['veh_id'],
                $vehicule['etatL'] == 'en_revision' ? 'Rendre disponible' : 'Passer en révision',
                $vehicule['veh_id']);
        } 
    ?>
</table>

<?php } ?>

<h1>Véhicules en cours de location</h1>

<?php $ligne_location = '<tr>
        <td><img src="./vues/assets/vehicules/%s"/></td>
        <td>%s</td>
        <td>%s</td>
        <td>%s</td>
        <td>%d€</td>
        <td>%s</td>
    </tr>';

    if(!isset($locations) || count($locations) == 0) {
        echo "<p>Aucune location est en cours.</p>";
    } else {
?>

<table class="liste" cellspacing=0>
    <tr>  
        <th>Véhicule</th>
        <th>Modèle</th>
        <th>Début</th>
        <th>Fin</th>
        <th>Prix total</th>
        <th>Locataire</th>
    </tr>

    <?php 
        foreach($locations as $location) {
            echo sprintf($ligne_location, 
                $location['vehicule']['photo'],
                $location['vehicule']['type'], 
                $location['dateD'], 
                $location['dateF'] == null ? 'Mensuel' : $location['dateF'], 
                $location['valeur'], 
                $location['client']['pseudo']);
        } 
    ?>
</table>

<?php } ?>

<form action="./index.php?controle=loueur&action=gestion" enctype="multipart/form-data" onsubmit="concatener()" method="post">
	<h1>Ajouter un véhicule au stock</h1>
	
	<p>Modèle</p>
	<input type="text" id="type" name="type" placeholder="Le modèle du véhicule" required />
	
	<p>Tarif journalier</p> 
	<input type="number" id="tarif" name="tarif" placeholder="Le tarif journalier" required />

    <p>Photo</p> 
	<input type="file" id="photo" name="photo" placeholder="image/*" required />

    <button type="button" onclick="ajouter()">Ajouter des caractéristiques</button>
    <div id="storage"></div>

    <input type="text" id="caract" name="caract" hidden />

	<input type="submit" value="Ajouter" />

    <p id='res'><?php echo (isset($resultat) ? $resultat : "") ?></p>
</form>

<br><a class="button" href="./index.php?controle=loueur&action=changer">Se connecter en tant que client</a>

<script src="./vues/scripts/ajouter_caract.js"></script>