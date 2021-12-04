<?php 

    function est_loueur($cli_id) {
        require('./modeles/connect.php');
		
        $stmt = $pdo->prepare('SELECT * FROM `loueur` WHERE cli_id=:cli_id;');
        $stmt->bindParam('cli_id', $cli_id, PDO::PARAM_STR);
        $stmt->execute();

        if(count($stmt->fetchAll()) > 0)
            return true;

        return false;
    }

?>