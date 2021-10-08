<?php  
	global $controle;  
	global $action;
?>

<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
   
        <title>Descars</title>

        <meta name="HandheldFriendly" content="true"/>
        <meta name="viewport" content="width=device-width, height=device-height"/>

        <link href="./vues/styles/style.css" rel="stylesheet"/>
        <link href="./vues/styles/styleh.css" rel="stylesheet" media="screen and (max-width: 1200px)"/>
    </head>

    <body>
        <?php require('menu.tpl'); ?>

        <main> 
		    <?php require("./vues/" . $controle . "/" . $action . ".tpl"); ?>  
	    </main>

        <footer>
            <p>Dans le cadre du projet de PWEB par Fatih KILIC
            <br>IUT de Paris (2021 - 2022)</p>
        </footer>
    </body>
</html>