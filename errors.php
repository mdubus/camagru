<?php
session_start();

function error_inscription()
{
	if ($_SESSION['inscription-identifiant'] == "KO")
	echo "<div id='inscription-ko'>Erreur : Veuillez renseigner un identifiant</div>";
	else if ($_SESSION['flag-user-exists'] == "KO")
	echo "<div id='inscription-ko'>Erreur : Cet identifiant existe déjà</div>";
	if ($_SESSION['inscription-mail'] == "KO")
	echo "<div id='inscription-ko'>Erreur : Veuillez renseigner une adresse mail</div>";
	else if ($_SESSION['flag-regex-mail'] == "KO")
	echo "<div id='inscription-ko'>Erreur : Veuillez indiquer une adresse email valide</div>";
	else if ($_SESSION['flag-mail-exists'] == "KO")
	echo "<div id='inscription-ko'>Erreur : Cette adresse mail est déjà utilisée</div>";
	if ($_SESSION['inscription-password1'] == "KO")
	echo "<div id='inscription-ko'>Erreur : Veuillez renseigner un mot de passe</div>";
	else if ($_SESSION['flag-regex-password'] == "KO")
	echo "<div id='inscription-ko'>Erreur : Votre mot de passe doit contenir au moins 6 caractères dont un chiffre</div>";
	if ($_SESSION['inscription-password2'] == "KO")
	echo "<div id='inscription-ko'>Erreur : Veuillez recopier votre mot de passe</div>";
	if ($_SESSION['same-password'] == "KO")
	echo "<div id='inscription-ko'>Erreur : Veuillez recopier votre mot de passe à l'identique</div>";
	if ($_SESSION['flag-inscription'] == "OK"){
		echo "<div id='inscription-ok'><p>Ton inscription a bien été prise en compte.</p>";
		echo "<p>Tu vas recevoir un mail de confirmation dans quelques instants.</p></div>";
	}
}

function delete_error_inscription()
{
	$_SESSION['inscription-identifiant'] = NULL;
	$_SESSION['flag-user-exists'] = NULL;
	$_SESSION['inscription-mail'] = NULL;
	$_SESSION['flag-regex-mail'] = NULL;
	$_SESSION['flag-mail-exists'] = NULL;
	$_SESSION['inscription-password1'] = NULL;
	$_SESSION['flag-regex-password'] = NULL;
	$_SESSION['inscription-password2'] = NULL;
	$_SESSION['same-password'] = NULL;
	$_SESSION['flag-inscription'] = NULL;
}

function	error_connexion()
{
	if ($_SESSION['connexion-mail'] == "KO")
	echo "<div id='inscription-ko'>Erreur : Veuillez renseigner une adresse mail</div>";
	else if ($_SESSION['connexion-mail-exists'] == "KO")
	echo "<div id='inscription-ko'>Erreur : Adresse mail inconnue</div>";
	if ($_SESSION['connexion-password'] == "KO")
	echo "<div id='inscription-ko'>Erreur : Veuillez renseigner un mot de passe</div>";
	if ($_SESSION['connexion-good-password'] == "KO")
	echo "<div id='inscription-ko'>Erreur : Mauvais mot de passe</div>";
}

function delete_error_connexion()
{
	$_SESSION['connexion-mail'] = NULL;
	$_SESSION['connexion-mail-exists'] = NULL;
	$_SESSION['connexion-password'] = NULL;
	$_SESSION['connexion-good-password'] = NULL;
}

function	error_reset_password()
{
	if ($_SESSION['flag-reset-password-mail-exists'] == "KO")
	echo "<div id='inscription-ko'>Erreur : Adresse mail inconnue</div>";
	if ($_SESSION['mail-reinit-password'] == "OK"){
		echo "<div id='inscription-ok'><p>Ta demande a bien été prise en compte.</p>";
		echo "<p>Tu vas recevoir un mail de réinitialisation dans quelques instants.</p></div>";
	}
	if ($_SESSION['flag-mail-exists-reset-my-password'] == "KO")
	echo "<div id='inscription-ko'>Erreur : Adresse mail inconnue</div>";
	if ($_SESSION['reset-password1'] == "KO")
	echo "<div id='inscription-ko'>Erreur : Veuillez renseigner un mot de passe</div>";
	else if ($_SESSION['reset-flag-regex-password'] == "KO")
	echo "<div id='inscription-ko'>Erreur : Votre mot de passe doit contenir au moins 6 caractères dont un chiffre</div>";
	if ($_SESSION['reset-password2'] == "KO")
	echo "<div id='inscription-ko'>Erreur : Veuillez recopier votre mot de passe</div>";
	else if ($_SESSION['reset-same-password'] == "KO")
	echo "<div id='inscription-ko'>Erreur : Veuillez recopier votre mot de passe à l'identique</div>";
	if ($_SESSION['reset-good-token'] == "KO")
	echo "<div id='inscription-ko'>Erreur : Le lien de réinitialisation est erroné</div>";
	if ($_SESSION['reinit-password-in-db'] == "OK"){
		echo "<div id='inscription-ok'><p>Ton mot de passe a bien été réinitialisé.</p>";
		echo "<p>Tu vas être redirigé vers l'accueil dans 5 secondes.</p></div>";
	}
}

function	delete_error_reset_password()
{
	$_SESSION['flag-reset-password-mail-exists'] = NULL;
	$_SESSION['mail-reinit-password'] = NULL;
	$_SESSION['flag-mail-exists-reset-my-password'] = NULL;
	$_SESSION['reset-password1'] = NULL;
	$_SESSION['reset-flag-regex-password'] = NULL;
	$_SESSION['reset-password2'] = NULL;
	$_SESSION['reset-same-password'] = NULL;
	$_SESSION['reset-good-token'] = NULL;
	$_SESSION['reinit-password-in-db'] = NULL;
}

function	error_post_comment()
{
	if ($_SESSION['comment-send'] == "KO")
		echo "<br/><br/><div id='inscription-ko'>Erreur lors de l'envoi du commentaire</div>";
	else if ($_SESSION['comment-send'] == "OK"){
		echo "<br/><br/><div id='inscription-ok'><p>Ton commentaire a bien été envoyé !</p>";
		if ($_SESSION['login'] != $_SESSION['login-target'])
		{
			echo "<p>".$_SESSION['login-target']." va en être informé par mail</p></div>";
		}
		else {
			echo "</div>";
		}
	}
	$_SESSION['comment-send'] = NULL;
}



function	error_change_password()
{
	if ($_SESSION['change-pass-old_pass'] == "KO")
		echo "<div id='inscription-ko'>Erreur : Veuillez renseigner votre ancien mot de passe</div>";
	else if ($_SESSION['flag-old-pass'] == "KO")
		echo "<div id='inscription-ko'>Erreur : Le mot de passe ne correspond pas</div>";
	if ($_SESSION['change-pass-pass1'] == "KO")
		echo "<div id='inscription-ko'>Erreur : Vous devez renseigner votre nouveau mot de passe</div>";
	else if ($_SESSION['flag-regex-password'] == "KO")
		echo "<div id='inscription-ko'>Erreur : Votre mot de passe doit contenir au moins 6 caractères dont un chiffre</div>";
	if ($_SESSION['change-pass-pass2'] == "KO")
		echo "<div id='inscription-ko'>Erreur : Veuillez recopier votre nouveau mot de passe</div>";
	else if ($_SESSION['same-password'] == "KO")
		echo "<div id='inscription-ko'>Erreur : Veuillez recopier le mot de passe à l'identique</div>";
	if ($_SESSION['flag-password-changed'] == "OK"){
		echo "<div id='inscription-ok'><p>Ton mot de passe a bien été modifié !</p><br/>";
		echo "<p>Tu vas être redirigé vers ton espace personnel dans 5 secondes.</p></div>";
	}
}

function delete_error_change_password()
{
	$_SESSION['change-pass-old_pass'] = NULL;
	$_SESSION['change-pass-pass1'] = NULL;
	$_SESSION['change-pass-pass2'] = NULL;
	$_SESSION['flag-regex-password'] = NULL;
	$_SESSION['same-password'] = NULL;
	$_SESSION['flag-old-pass'] = NULL;
	$_SESSION['flag-password-changed'] = NULL;
}





?>
