<div>
    <h1>Fiche technique</h1>
    <img src="./vues/assets/vehicules/<?php echo $vehicule['photo']; ?>"/>
    <p><?php echo $vehicule['type']; ?></p>

    <div>
        <table>
            <tr>
                <th colspan=2>Informations</th>
            </tr>

            <tr>
                <th>Tarif</th>
                <td><span id='tarif'><?php echo $vehicule['tarif']; ?></span>€ par jour</td>
            </tr>

            <tr>
                <th>Etat</th>
                <td>
                    <?php 
                        if($vehicule['etatL'] == 'disponible') 
                            echo 'Le véhicule est disponible'; 
                        else if($vehicule['etatL'] == 'en_revision')
                            echo 'Le véhicule est en révision';
                        else
                            echo 'Le véhicule est déjà en location';
                    ?>
                </td>
            </tr>
        </table>
    </div>

    <div>
        <table> 
            <tr>
                <th colspan=2>Caractéristiques</th>
            </tr>

            <?php 
                $data = json_decode($vehicule['caract']); 

                foreach($data as $key => $value) {
                    echo '<tr><th>' . $key . '</th><td>' . $value . '</td></tr>';
                }
            ?>
        </table>
    </div>
</div>

<?php if($vehicule['etatL'] == 'disponible' && $est_client) {  ?>
    <form id="louer" action="./index.php?controle=vehicule&action=visualiser&id=<?php echo $_GET['id']; ?>" method="post">
        <h1><?php echo $dans_panier ? 'Ce véhicule est déjà dans votre panier' : 'Louer ce véhicule' ?> </h1>
        
        <?php if($dans_panier) { ?>
            <input type="submit" name="retrait" value="Retirer du panier" />
        <?php } else { ?>
            <p>Date de début</p>
            <input type="date" id="debut" name="debut" value=<?php echo $date; ?> required />
            
            <p>Date de fin</p> 
            <small>(un mois si non indiqué)</small>
            <input type="date" id="fin" name="fin" />

            <p>Coût prévisionnel</p> 
            <input type="text" id="prix" name="prix" placeholder="Veuillez choisir une date de début" disabled />
              
            <input type="submit" name="ajout" value="Ajouter au panier" />

            <p id='res'><?php echo (isset($resultat) ? $resultat : "") ?></p>
            <p id='output'></p>
        <?php } ?>
    </form>
<?php } ?>

<a class="button" href="index.php?controle=vehicule&action=parcourir">Retour</a>

<script src="./vues/scripts/prevision_prix.js"></script>