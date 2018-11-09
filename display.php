
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

      <p> <form action=index.php" method="post">
        <label for="message">Message</label> :  <input type="text" name="message" id="message" /><br />
        <input type="submit" value="Envoyer" /><br />
      </p></form>
      <a href="index.php?quit=true">Se deconnecter</a><br />

    <?php }else{  ?>

      <div class="container ">

        <h3>Connection</h3>
        <p> 
          <form action="index.php" method="post">
            <div class="row">
              <div class="col">
                <label for="pseudo">Pseudo</label> :</div> <div class="col"><input type="text" name="lpseudo" id="pseudo" />
                </div>
              </div>
              <br /> 
              <div class="row">
                <div class="col">
                  <label for="pass">Mot de passe</label> :</div> <div class="col"> <input type="password" name="lpass" id="pass" />
                  </div>
                </div>
                <br />
                <div class="row">
                  <div class="col">
                    <input type="submit" value="Envoyer" />
                  </div>
                </div>
              </form> 
            </p>
          </div>

          <div class="container">

            <h3>Inscription</h3>
            <p> 
              <form action="index.php" method="post">
                <div class="row">
                  <div class="col">
                    <label for="pseudo">Pseudo</label> :</div> <div class="col"> <input type="text" name="rpseudo" id="pseudo" />
                    </div>
                  </div>
                  <br />
                  <div class="row">
                    <div class="col">
                      <label for="mail">E-mail</label> :</div> <div class="col"> <input type="email" name="rmail" id="mail" />
                      </div>
                    </div>
                    <br />
                    <div class="row">
                      <div class="col">
                        <label for="pass">Mot de passe</label> :</div> <div class="col"> <input type="password" name="rpass" id="pass" />
                        </div>
                      </div>
                      <br />
                      <div class="row">
                        <div class="col">
                          <label for="passC">Confirmer votre mot de passe</label> :</div> <div class="col"> <input type="password" name="rpassC" id="passC" />
                          </div>
                        </div>
                        <br />
                        <input type="submit" value="Envoyer" />
                      </form>
                    </p>
                  </div>
                  <?php
                }
                if(isset($_SESSION['statut'] )){
                  echo $_SESSION['statut'] ;
                }

                ?>
              </div>



            </body>
            </html>