<nav>
<a href="index.php?controle=client&action=accueil">Descars</a>

    <div>
        <ul>
            <?php 
                $lien = '<li><a href="index.php?controle=%s&action=%s">%s</a></li>';

                echo sprintf($lien, 'client', 'accueil', '๐ฅ๏ธ Accueil');
                echo sprintf($lien, 'vehicule', 'parcourir', '๐ Parcourir');

                if(isset($_SESSION['client'])) {
                    if($_SESSION['client']['role'] == 'client') {
                        echo sprintf($lien, 'client', 'dashboard', '๐ค Tableau de bord');
                        echo sprintf($lien, 'client', 'panier', '๐๏ธ Panier');
                    } else {
                        echo sprintf($lien, 'loueur', 'gestion', 'โ๏ธ Gestion');
                    }

                    echo sprintf($lien, 'client', 'deconnection', '๐โโ๏ธ Se dรฉconnecter');
                } else {
                    echo sprintf($lien, 'client', 'authentification', "๐ S'authentifier");
                }
            ?>
        </ul>
    </div>
</nav>