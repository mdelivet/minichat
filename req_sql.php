<?php

function co() {
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
		return $bdd;
	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}
}

function getUser() {
	$bdd = co();
	$reponse = $bdd->prepare('SELECT * FROM utilisateurs ORDER BY ID 	');
	$reponse->execute();
	return $reponse;
}


function register($pseudo, $adresseMail, $motDePasse) {
		$bdd = co();

	$req = $bdd->prepare('INSERT INTO utilisateurs (pseudo, adresseMail, motDePasse) VALUES(:pseudo, :adresseMail, :motDePasse)');
	$req->bindParam(":pseudo", $pseudo);
	$req->bindParam(":adresseMail", $adresseMail);
	$req->bindParam(":motDePasse", $motDePasse);
	$req->execute();
}

function login(){
		$bdd = co();
	$reponse = $bdd->query('SELECT id, pseudo, motDePasse FROM utilisateurs ORDER BY ID ');

	while ($donnees = $reponse->fetch())
	{
		if($donnees['pseudo'] == $_POST['lpseudo'] && $donnees['motDePasse'] == $_POST['lpass']){
			$_SESSION['pseudoID']=$donnees['id'];

		}
	}
		 
	$reponse->closeCursor();
		if(isset($_SESSION['pseudoID'] )){
			$_SESSION['statut']="Vous etes connecter!";
		}else{
			$_SESSION['statut']="Votre pseudo ou mot de passe est incorect.";
	
		}
	header('Location: index.php');

}
function quit(){
	session_destroy();
	header('Location: index.php');

}
function post(){
	$bdd = co();

	$req = $bdd->prepare('INSERT INTO minichat (idpseudo, message) VALUES(?, ?)');
	$req->execute(array($_SESSION['pseudoID'], $_POST['message']));
	header('Location: index.php');

}
function getMessage(){
	$bdd = co();
$reponse = $bdd->query('SELECT utilisateurs.id, utilisateurs.pseudo, minichat.idpseudo, minichat.message FROM minichat, utilisateurs Where minichat.idpseudo = utilisateurs.id ORDER BY ID DESC LIMIT 0, 10');
		return $reponse;

}
