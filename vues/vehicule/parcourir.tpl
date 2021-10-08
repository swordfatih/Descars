<div class='box'>
    <?php
        foreach($vehicules as $vehicule) {
            echo '<div>';
                echo '<p>' . $vehicule['type'] . '</p>';
                echo '<p>' . $vehicule['nb'] . '</p>';

                echo '<img src="' . $vehicule['photo'] . '"/>';

                echo "<div>Appuyez pour plus d'informations</div>";

                $loué = $vehicule["etatL"] == 1;

                echo '<a class="button ';
                
                if($loué) 
                    echo 'disabled';
                else
                    echo 'disponible';
                
                echo '" href="index.php?controle=vehicule&action=commander">';
                
                if($loué) 
                    echo "Non disponible"; 
                else 
                    echo "Louer";
                
                echo '</a>';
            echo '</div>';
        }
    ?>
</div>

<script>
    let elements = document.getElementsByTagName('img');
    for(let index in elements)
        elements[index].onclick = function() { alert("Informations supplémentaires"); };
</script>