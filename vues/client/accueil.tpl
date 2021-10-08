<section>
    <div></div> <!-- Vertical spacing -->
    <article>
        <?php if(isset($client)) { 
            echo '<h1>Bienvenue ' . $client["pseudo"] . '</h1>';
        } else { ?>
            <h1>Location de véhicules</h1>
        <?php } ?>

        <p>Les plus belles voitures à votre portée.</p>
        <a class="button" href="index.php?controle=vehicule&action=parcourir">Parcourir</a>
    </article>
</section>