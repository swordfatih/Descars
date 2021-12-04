<nav>
<a href="index.php?controle=client&action=accueil">Descars</a>

    <div>
        <ul>
            <?php 
                $lien = '<li><a href="index.php?controle=%s&action=%s">%s</a></li>';

                echo sprintf($lien, 'client', 'accueil', '🖥️ Accueil');
                echo sprintf($lien, 'vehicule', 'parcourir', '🚗 Parcourir');

                if(isset($_SESSION['client'])) {
                    if($_SESSION['client']['role'] == 'client') {
                        echo sprintf($lien, 'client', 'dashboard', '🖤 Tableau de bord');
                        echo sprintf($lien, 'client', 'panier', '🛍️ Panier');
                    } else {
                        echo sprintf($lien, 'loueur', 'gestion', '⚙️ Gestion');
                    }

                    echo sprintf($lien, 'client', 'deconnection', '🏃‍♀️ Se déconnecter');
                } else {
                    echo sprintf($lien, 'client', 'authentification', "🔐 S'authentifier");
                }
            ?>
        </ul>
    </div>
</nav>