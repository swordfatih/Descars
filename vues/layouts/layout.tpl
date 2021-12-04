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

        <link rel="shortcut icon" href="#" />

        <link href="./vues/styles/main.css" rel="stylesheet"/>
        <link href="./vues/styles/<?php echo $controle . "/" . $action; ?>.css" rel="stylesheet"/>

        <?php 
            $path = "./vues/styles/objets/"; 
            foreach(scandir($path) as $file) 
                if(substr($file, 0, 1) !== ".") 
                    echo '<link href="' . $path . $file . '" rel="stylesheet"/>'; 
        ?>
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