<form action="./index.php?controle=client&action=inscription" method="post">
	<h1>Créer votre compte</h1>

	<p>Nom</p>
	<input type="text" id="nom" name="nom" placeholder="Votre nom" />

	<p>Pseudo</p>
	<input type="text" id="pseudo" name="pseudo" placeholder="Votre pseudonyme" />
	
	<p>Email</p>
	<input type="email" id="email" name="email" placeholder="Votre e-mail" />

	<p>Mot de passe</p> 
	<input type="password" id="mdp" name="mdp" placeholder="Votre mot de passe" />

	<p>Société</p>
	<input type="text" id="nomE" name="nomE" placeholder="Le nom de votre entreprise" />

	<p>Adresse</p>
	<input type="text" id="adresseE" name="adresseE" placeholder="L'adresse de votre entreprise" />

	<input type="submit" value="Finaliser l'inscription" />

	<p id='res'><?php echo (isset($resultat) ? $resultat : "") ?></p>
	<a class="button" href="./index.php?controle=client&action=authentification">Vous avez déjà un compte ?</a>
</form>