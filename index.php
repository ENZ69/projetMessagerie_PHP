<?php
session_start();
include_once "header.php";
require_once "models/fonctions.php";

if (isset($_POST['btnConnect'])) {
    extract($_POST);

    $user = findUser($login,$mdp);
    if ($user == null) { 
        echo '<div class="alert alert-danger text-white col-md-5 container mt-3 text-center" style="background-color: pink;"> Login ou Mot de Passe incorrect !</div>';
    } else{
        $_SESSION['id'] = $user['idUser'];
        $_SESSION['nom'] = $user['nomComplet'];
        var_dump($_SESSION);
        header("location:http://localhost/projetPHP/acceuil.php");
    }
}
?>
<body style="background-color:#efefef;">
    <div class="container col-md-4 mt-4">
        <div class="card">
            <div class="card-header bg-primary text-center text-white" style="font-size:25px;">Authentification</div>
            <div class="card-body">
               <form method="post">
                    <div class="row ">
                            <div class="col-md-6">
                                <label for="" class="h6">Login</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="login" class="form-control" id="login">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6">
                            <label for="" class="h6">Mot de Passe</label>
                            </div>
                            <div class="col-md-6">
                            <input type="password" name="mdp" class="form-control" id="mdp">
                            </div>
                        </div>
                        <div class="row mt-4 align-items-center">
                            <div class="col-md-6">
                                <a href="#creation" class="btn btn-primary" data-toggle = "modal">Creer un compte</a>
                            </div>
                            <div class="col-md-6 align-items-center">
                            <button class="btn btn-primary" name="btnConnect">Se Connecter</button>
                            </div>
                        </div>
               </form>
            </div>
        </div>
    </div>

<div class="modal fade " id="creation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white " id="exampleModalLabel">Création du Compte</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST">
          <div class="modal-body">
             <div class="mt-4">
                 <label for="" class="h6">Nom Complet</label>
                 <input type="text" class="form-control" name="nom">
             </div>
             <div  class="mt-4">
                 <label for="" class="h6">Login</label>
                 <input type="text" class="form-control" name="login">
             </div>
             <div class="mt-4">
                 <label for="" class="h6">Mot de passe</label>
                 <input type="password" class="form-control" name="mdp">
             </div>
             <div class="mt-4">
                 <label for="" class="h6">Téléphone</label>
                 <input type="text" class="form-control" name="tel">
             </div>
         </div>
         <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
              <button type="submit" class="btn btn-primary" name="enregistrer">Enregistrer</button>
         </div>
      </form>
    </div>
  </div>
</div>
</div>

</body>
<script src="http://localhost/projetPHP/public/js/jquery-3.3.1.js"></script>
<script src="http://localhost/projetPHP/public/js/bootstrap.js"></script>
<script src = "http://localhost/projetPHP/public/js/jquery.dataTables.js"></script>
<script src = "http://localhost/projetPHP/public/js/dataTables.bootstrap4.js"></script>
</html>
<?php
if(isset($_POST ['enregistrer']))
{
    extract($_POST);
    $resultat=AjoutUser($nom,$login, $mdp, $tel);
}
?>