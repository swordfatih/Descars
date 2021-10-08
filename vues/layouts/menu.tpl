<nav>
    <a href="index.php?controle=client&action=accueil">Descars</a>
    <li><a href="index.php?controle=client&action=accueil">🖥️ Accueil</a></li>

    <?php if(isset($_SESSION['client'])) { ?>
        <li><a href="index.php?controle=client&action=deconnection">🏃‍♀️ Se déconnecter</a></li>
        <li><a href="index.php?controle=abonnes&action=dashboard">🖤 Tableau de bord</a></li>

    <?php } else { ?>
        <li><a href="index.php?controle=client&action=authentification">🔐 S'identifier</a></li>
    <?php } ?>

    <li><a href="index.php?controle=vehicule&action=parcourir">🚗 Parcourir</a></li>
    <li><a href="index.php?controle=client&action=panier">🛍️ Panier</a></li>
</nav>