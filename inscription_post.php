<?php
session_start();
$validInscription = true;
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}


	//Inscription
$reponse = $bdd->query('SELECT id, pseudo, adresseMail FROM utilisateurs ORDER BY ID ');

while ($donnees = $reponse->fetch())
{
	if($donnees['pseudo'] == $_POST['pseudo'] ) {
		$_SESSION['statut']="Ce pseudo existe dejà";
		$validInscription=false;
	}
	if($donnees['adresseMail'] == $_POST['mail'] ) {
		$_SESSION['statut']="Cet email existe dejà";
		$validInscription=false;
	}
}

$reponse->closeCursor();

	//Confirm Inscription
	if($_POST['passC'] != $_POST['pass'] ) {

		$_SESSION['statut']="Vos mots de passe sont different";
		$validInscription=false;
	}
	if($validInscription== true){
$req = $bdd->prepare('INSERT INTO utilisateurs (pseudo, adresseMail, motDePasse) VALUES(?, ?, ?)');
$req->execute(array($_POST['pseudo'], $_POST['mail'], $_POST['pass']));
		$_SESSION['statut']="Votre inscription a bien été effectuée";

}
	



header('Location: minichat.php');
?>