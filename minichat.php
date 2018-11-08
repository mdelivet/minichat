<!DOCTYPE html>
<?php

session_start();
?>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mini-chat</title>
    </head>
    <style>
    form
    {
        text-align:center;
    }
    </style>
    <body>
    
    <form action="minichat_post.php" method="post">
        <p>
         <?php
            if(isset($_SESSION['pseudoID'] )){
                echo'<label for="message">Message</label> :  <input type="text" name="message" id="message" /><br />';
                echo'<input type="submit" value="Envoyer" /><br />';

                echo'<a href="deconnect.php">Se deconnecter</a>';
            }else{
                echo' <label for="pseudo">Pseudo</label> : <input type="text" name="pseudo" id="pseudo" /><br />'; 
                echo '<label for="pass">Mot de passe</label> : <input type="password" name="pass" id="pass" /><br />';
                echo'<input type="submit" value="Envoyer" />';

            }
        ?>


            
        </p>
    </form>

<?php

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

?>
    </body>
</html>