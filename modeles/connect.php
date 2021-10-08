<?php
	$pdo = null;
	$hostname = "localhost";
	$bdd = "descars";
	$username = "root";
	$password = "root";

	try
	{
		$pdo = new PDO("mysql:host=$hostname;dbname=$bdd", $username, $password);   
		$pdo->query("SET NAMES 'utf8';");
	} catch( PDOException $e ) {
		echo "Erreur de connection à la base de données SQL :", $e->getMessage();
		die();
	}
?>