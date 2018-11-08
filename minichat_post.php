<?php
session_start();
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

if(isset($_SESSION['pseudoID'] )){
	//Envoie Message
$req = $bdd->prepare('INSERT INTO minichat (idpseudo, message) VALUES(?, ?)');
$req->execute(array($_SESSION['pseudoID'], $_POST['message']));
}else{
	//Connection
$reponse = $bdd->query('SELECT id, pseudo, motDePasse FROM utilisateurs ORDER BY ID ');

while ($donnees = $reponse->fetch())
{
	if($donnees['pseudo'] == $_POST['pseudo'] && $donnees['motDePasse'] == $_POST['pass']){
		$_SESSION['pseudoID']=$donnees['id'];
				$_SESSION['statut']="Vous etes connecter!";

	}else{
				$_SESSION['statut']="Votre pseudo ou mot de passe est incorect.";
	}
}

$reponse->closeCursor();
}




header('Location: minichat.php');
?>