<?php




function register(){
	try
{
	$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
}
catch(Exception $e)
{
	die('Erreur : '.$e->getMessage());
}
	$reponse = $bdd->query('SELECT id, pseudo, adresseMail FROM utilisateurs ORDER BY ID ');

	while ($donnees = $reponse->fetch())
	{
		if($donnees['pseudo'] == $_POST['rpseudo'] ) {
			$_SESSION['statut']="Ce pseudo existe dejà";
			$validInscription=false;
		}
		if($donnees['adresseMail'] == $_POST['rmail'] ) {
			$_SESSION['statut']="Cet email existe dejà";
			$validInscription=false;
		}
	}

	$reponse->closeCursor();

//Confirm Inscription
	if($_POST['rpassC'] != $_POST['rpass'] ) {

		$_SESSION['statut']="Vos mots de passe sont different";
		$validInscription=false;
	}
	if($validInscription== true){
		$req = $bdd->prepare('INSERT INTO utilisateurs (pseudo, adresseMail, motDePasse) VALUES(?, ?, ?)');
		$req->execute(array($_POST['rpseudo'], $_POST['rmail'], $_POST['rpass']));
		$_SESSION['statut']="Votre inscription a bien été effectuée";

	}
	header('Location: index.php');

}
function login(){
	try
{
	$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
}
catch(Exception $e)
{
	die('Erreur : '.$e->getMessage());
}
	$reponse = $bdd->query('SELECT id, pseudo, motDePasse FROM utilisateurs ORDER BY ID ');

	while ($donnees = $reponse->fetch())
	{
		if($donnees['pseudo'] == $_POST['lpseudo'] && $donnees['motDePasse'] == $_POST['lpass']){
			$_SESSION['pseudoID']=$donnees['id'];
			$_SESSION['statut']="Vous etes connecter!";

		}else{
			$_SESSION['statut']="Votre pseudo ou mot de passe est incorect.";
		}
	}

	$reponse->closeCursor();
	header('Location: index.php');

}
function quit(){
	session_destroy();
	header('Location: index.php');

}
function post(){
	try
{
	$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
}
catch(Exception $e)
{
	die('Erreur : '.$e->getMessage());
}
	$req = $bdd->prepare('INSERT INTO minichat (idpseudo, message) VALUES(?, ?)');
	$req->execute(array($_SESSION['pseudoID'], $_POST['message']));
	header('Location: index.php');

}
function display(){
	try
{
	$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
}
catch(Exception $e)
{
	die('Erreur : '.$e->getMessage());
}
	$reponse = $bdd->query('SELECT utilisateurs.id,utilisateurs.pseudo, minichat.message, minichat.idpseudo FROM minichat, utilisateurs Where minichat.idpseudo = utilisateurs.id ORDER BY ID DESC LIMIT 0, 10');

	while ($donnees = $reponse->fetch())
	{
		echo '<p><strong>' . htmlspecialchars($donnees['pseudo']) . '</strong> : ' . htmlspecialchars($donnees['message']) . '</p>';
	}

	$reponse->closeCursor();
	return;

}
