
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="../lib/js/jquery.js"></script>
<script src="../lib/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../lib/css/bootstrap.min.css">

<title>Mini-chat</title>
</head>



<body>
<!-- Button trigger modal
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
Launch demo modal
</button>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
...
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<button type="button" class="btn btn-primary">Save changes</button>
</div>
</div>
</div>
</div> -->

<div class="container">

<?php
if(isset($_SESSION['pseudoID'] )){
?>

<p> <form action="index.php" method="post">
<label for="message">Message</label> :  <input type="text" name="message" id="message" /><br />
<input type="submit" value="Envoyer" /><br />
</p></form>
<a href="index.php?quit=true">Se deconnecter</a><br />

<?php }else{  ?>

<div class="container bg-info">

<h3>Connection</h3></br>
<p> 
<form action="index.php" method="post">
  <div class="row">
    <div class="col">
      <label for="pseudo">Pseudo</label> :</div> <div class="col"><input type="text" class="form-control" name="lpseudo" id="pseudo" />
      </div>
    </div>
    <br /> 
    <div class="row">
      <div class="col">
        <label for="pass">Mot de passe</label> :</div> <div class="col"> <input type="password" class="form-control" name="lpass" id="pass" />
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

</br>
<div class="container bg-info">

  <h3>Inscription</h3></br>
  <p> 
    <form action="index.php" method="post">
      <div class="row">
        <div class="col">
          <label for="pseudo">Pseudo</label> :</div> <div class="col"> <input type="text" class="form-control" name="rpseudo" id="pseudo" />
          </div>
        </div>
        <br />
        <div class="row">
          <div class="col">
            <label for="mail">E-mail</label> :</div> <div class="col"> <input type="email" class="form-control" name="rmail" id="mail" />
            </div>
          </div>
          <br />
          <div class="row">
            <div class="col">
              <label for="pass">Mot de passe</label> :</div> <div class="col"> <input type="password" class="form-control" name="rpass" id="pass" />
              </div>
            </div>
            <br />
            <div class="row">
              <div class="col">
                <label for="passC">Confirmer votre mot de passe</label> :</div> <div class="col"> <input type="password" class="form-control" name="rpassC" id="passC" />
                </div>
              </div>
              <br />
              <input type="submit" value="Envoyer" />
            </form>
          </p>
        </div>
  <div class="alert alert-danger" role="alert">

        <?php
      }
      if(isset($_SESSION['statut'] )){
        echo $_SESSION['statut'] ;
      }
      ?>
    </div>

    </div>
     <div class="container text-white-50 bg-secondary">
        <?php 
         if(isset($_SESSION['pseudoID'] )){
              $reponse = getMessage();
              while ($donnees = $reponse->fetch())
              {
                echo '<p><strong>' . htmlspecialchars($donnees['pseudo']) . '</strong> : ' . htmlspecialchars($donnees['message']) . '</p>';
              }
         }

        ?>
  </div>



  </body>
  </html>