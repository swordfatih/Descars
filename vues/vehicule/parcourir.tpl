<div>
    <h1>Parcourir les véhicules</h1>
</div>

<div class='box'>
    <?php
        $boite = '
            <div>
                <p>%s</p>
                <p>%s€ par jour</p>
                <img class="%s" src="./vues/assets/vehicules/%s"/>
                <div>%s</div>
                <a class="button %s" href="index.php?controle=vehicule&action=visualiser&id=%d#louer">%s</a>
            </div>';    

        foreach($vehicules as $i => $vehicule) {
            $dans_panier = isset($_SESSION['panier'][$vehicule['veh_id']]);
            $etat = $vehicule["etatL"];
            
            echo sprintf($boite, 
                $vehicule['type'],
                $vehicule['tarif'], 
                $etat != 'disponible' ? 'indisponible' : $etat, 
                $vehicule['photo'],
                $etat == 'disponible' ? "Appuyez pour plus d'informations" : "",
                $etat != 'disponible' ? 'disabled' : 'enabled',
                $i + 1,
                $etat == 'en_revision' ? "En revision" : ($etat == 'disponible' ? ($dans_panier ? "Retirer du panier" : "Ajouter au panier") : 'Indisponible'));
        }
    ?>
</div>

<script>
    let elements = document.getElementsByTagName('img');

    <?php 
        foreach($vehicules as $i => $vehicule) { 
            echo 'elements[' . $i . '].onclick = function() {'; 
                echo 'if(elements[' . $i . '].className == "disponible")';
                echo 'window.location.replace("index.php?controle=vehicule&action=visualiser&id=' . ($vehicule['veh_id']) . '");';
            echo '};';
        }
    ?>
</script>