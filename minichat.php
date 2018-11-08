
<?php

session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../lib/css/bootstrap.min.css">
        <script src="../lib/js/jquery-3.3.1.min.js"></script>
        <script src="../lib/js/bootstrap.min.js"></script>

        <title>Mini-chat</title>
    </head>
    
    <body>
         <div class="container">

             <?php
                if(isset($_SESSION['pseudoID'] )){
                                ?>

                    //Envoie Message

                        <p> <form action="minichat_post.php" method="post">
                    <label for="message">Message</label> :  <input type="text" name="message" id="message" /><br />
                    <input type="submit" value="Envoyer" /><br />
                      </p></form>';
                    <a href="deconnect.php">Se deconnecter</a>

                <?php }else{            ?>

                        <div class="container">
                        <p>Connection</p>
                        <p> <form action="minichat_post.php" method="post">
                            
                            
                     <div class="row"><div class="col"><label for="pseudo">Pseudo</label> :</div> <div class="col"><input type="text" name="pseudo" id="pseudo" /></div></div><br /> 
                     <div class="row"><div class="col"><label for="pass">Mot de passe</label> :</div> <div class="col"> <input type="password" name="pass" id="pass" /></div></div><br />
                     <div class="row"><div class="col"><input type="submit" value="Envoyer" /></div></div>
                      </p></form></div>

                        <div class="container">

                        <p>Inscription</p>
                        <p> <form action="inscription_post.php" method="post">
                     <div class="row"><div class="col"><label for="pseudo">Pseudo</label> :</div> <div class="col"> <input type="text" name="pseudo" id="pseudo" /></div></div><br />
                     <div class="row"><div class="col"><label for="mail">E-mail</label> :</div> <div class="col"> <input type="email" name="mail" id="mail" /></div></div><br />
                    <div class="row"><div class="col"><label for="pass">Mot de passe</label> :</div> <div class="col"> <input type="password" name="pass" id="pass" /></div></div><br />
                    <div class="row"><div class="col"><label for="passC">Confirmer votre mot de passe</label> :</div> <div class="col"> <input type="password" name="passC" id="passC" /></div></div><br />
                   <input type="submit" value="Envoyer" />
                    </p></form>
                </div>
 <?php
                }
                if(isset($_SESSION['statut'] )){
                    echo $_SESSION['statut'] ;
                }

            ?>
        </div>

        <div class="container">

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
        </div>

    </body>
</html>