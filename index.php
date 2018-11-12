<?php 
	session_start();
	require('req_sql.php'); 

	


	if(isset($_POST['rpseudo']))
	{
			$validInscription=true;


		$reponse = getUser();
		while ($donnees = $reponse->fetch()) {
			if($donnees['pseudo'] == $_POST['rpseudo'] ) {
				$_SESSION['statut']="Ce pseudo existe dejà";
				$validInscription=false;
			}
			if($donnees['adresseMail'] == $_POST['rmail'] ) {
				$_SESSION['statut']="Cet email existe dejà";
				$validInscription=false;
			}
		}


		if($_POST['rpassC'] != $_POST['rpass'] ) {

			$_SESSION['statut']="Vos mots de passe sont different";
			$validInscription=false;
		}
		if($validInscription== true){
			register($_POST['rpseudo'], $_POST['rmail'], $_POST['rpass']);
			$_SESSION['statut']="Votre inscription a bien été effectuée";

		}
		header('Location: index.php');
	} 
	if(isset($_POST['lpseudo']))
	{
		login();
	} 
	if(isset($_POST['message']))
	{
		post();
	} 
	if (isset($_GET['quit']))
    {
		quit();
    }

    require('display.php'); 