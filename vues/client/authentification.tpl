<form action="./index.php?controle=client&action=authentification" method="post">
	<h1>Accéder à votre espace personnel</h1>
	
	<p>E-mail</p>
	<input type="email" id="email" name="email" placeholder="Votre e-mail" />
	
	<p>Mot de passe</p> 
	<input type="password" id="mdp" name="mdp" placeholder="Votre mot de passe" />

	<p>Se connecter en tant que</p>
	<div>
		<div>
			<label for="client">Client</label>
			<input type="radio" id="client" name="role" value="client" checked>
		</div>	
		
		<div>
			<label for="loueur">Loueur</label>
			<input type="radio" id="loueur" name="role" value="loueur">
		</div>
	</div>

	<input type="submit" value="Se connecter" />

	<p id='res'><?php echo (isset($resultat) ? $resultat : "") ?></p>
	<a class="button" href="./index.php?controle=client&action=inscription">Créer un compte</a>
</form>