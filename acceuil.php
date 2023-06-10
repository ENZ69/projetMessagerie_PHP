<?php
session_start();
if(empty($_SESSION)){
    header("location:http://localhost/projetPHP/index.php");

}
include_once "header.php";
require_once "models/fonctions.php";

 $users = findDest($_SESSION['id']);

 if(isset($_POST['btnEnvoyer'])){
     $exp = getname1($_SESSION['id']);
     $exp1 = $exp['nomComplet'];
     extract($_POST);
     $desti = getname1($dest);
     $desti1 = $desti['nomComplet'];
     addMessages($exp1, $_SESSION['id'], $desti1, $objet, $message, $dest);
     header("location:http://localhost/projetPHP/acceuil.php");
    }
if(isset($_POST['btnTrans'])){
    $exp = getname1($_SESSION['id']);
    $exp1 = $exp['nomComplet'];
    extract($_POST);
    $desti = getname1($dest);
    $desti1 = $desti['nomComplet'];
    addMessages($exp1, $_SESSION['id'], $desti1, $objet, $message, $dest);
    header("location:http://localhost/projetPHP/acceuil.php");
    }

$messup = getSup($_SESSION['id']);
  
if(isset($_GET['deconnexion'])){
    session_unset();
    header("location:http://localhost/projetPHP/index.php");
}
if(isset($_POST['btnRep'])){
  $exp = getname1($_SESSION['id']);
     $exp1 = $exp['nomComplet'];
     extract($_POST);
     $desti = getname1($dest);
     $desti1 = $desti['nomComplet'];
     rep($exp1, $_SESSION['id'], $destrep, $objet, $message, $iddest);
     header("location:http://localhost/projetPHP/acceuil.php");
}
    $tabMessages = getMessages($_SESSION['id']);
    $tabMess= getMess($_SESSION['nom']);
?>
<body style="font-family:'Times New Roman', Times, serif; background-color:#efefef;">
    <div class="container mt-4 text-center">
      
          <div > 
              <h3 class=" bg-primary">Bienvenue <span style="color:yellow;"><?=  $_SESSION['nom'] ?></span> </h3>
          </div>
          <div class="col-md-6 d-flex">
              <a href="?deconnexion" class="btn btn-danger ">Se déconnecter</a>
              <a href="#messup" class="btn btn-danger offset-1" data-toggle = "modal">Messages supprimés</a>
          </div>
        
       
    </div>
    <br>
    <div class="container ">
  
        
         <h4 class="text-primary"><center>Messages Reçus</center></h4>
        
        <div class="mt-4">
        <a href="#nouveau" class="btn btn-primary float-right" data-toggle = "modal"><i class="fa-solid fa-pen-field"></i> Nouveau Message</a>
            <table class="table table-bordered" id="listeRecu">
                <thead class="bg-primary text-white text-center">
                <tr>
                    <th>Expediteur</th>
                    <th>Objet</th>
                    <th>Contenu</th>
                    <th>Date et Heure</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody class="text-center">
                <?php foreach ($tabMess as $ms ) { ?>
                        <tr>
                            <td><?= $ms['ex']?></td>
                            <td><?=$ms['objet'] ?></td>
                            <td><?= strlen($ms['contenu'])<20 ? $ms['contenu'] : substr($ms['contenu'],0,20)." ..." ?></td>
                            <td><?=$ms['date'] ?></td>
                            <td>
                                <span hidden id="id<?=$ms['id']?>"><?=$ms['id']."~".$ms['ex']."~".$ms['des']."~".$ms['objet']."~".$ms['contenu']."~".$ms['date']."~".$ms['exID']?></span>
                                <a href="#detail" class="btn btn-primary" onclick="remplirModal(`id<?=$ms['id']?>`)" data-toggle="modal" >Details</a>
                                <a href="#suppression" class="btn ml-2 btn-danger" onclick="remplirModal(`id<?=$ms['id']?>`)" data-toggle="modal">Supprimer</a>
                            </td>
                        </tr>
                    <?php  }?>
                </tbody>
            </table>
        </div>
       
        <center><div class="col-md-6"><h4 class="text-primary">Messages Envoyé</h4></div></center>
            
        
        <div class="mt-4">
            <table class="table table-bordered" id="listeSend">
                <thead class="bg-primary text-white text-center">
                <tr>
                    <th>Destinataire</th>
                    <th>Objet</th>
                    <th>Contenu</th>
                    <th>Date et Heure</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody class="text-center">
                    <?php foreach ($tabMessages as $m ) { ?>
                        <tr>
                            <td><?= $m['des'] ?></td>
                            <td><?=$m['objet'] ?></td>
                            <td><?= strlen($m['contenu'])<20 ? $m['contenu'] : substr($m['contenu'],0,20)." ..." ?></td>
                            <td><?=$m['date'] ?></td>
                            <td>
                                <span hidden id="id<?=$m['id']?>"><?=$m['id']."~".$m['ex']."~".$m['des']."~".$m['objet']."~".$m['contenu']."~".$m['date']."~".$m['idUserF']?></span>
                                <a href="#detail" class="btn btn-primary"  onclick="remplirModal(`id<?=$m['id']?>`)" data-toggle="modal" >Details</a>
                                <a href="#suppression" class="btn ml-2 btn-danger" onclick="remplirModal(`id<?=$m['id']?>`)" data-toggle="modal">Supprimer</a>
                            </td>
                        </tr>
                    <?php  }?>
                </tbody>
            </table>
        </div>
    </div>
<div class="modal fade " id="nouveau" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white " id="exampleModalLabel">Nouveau Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST">
          <div class="modal-body">
             <div class="mt-4">
                 <label for="" class="h6">Objet</label>
                 <input type="text" value="" class="form-control" name="objet">
             </div>
             <div class="mt-4">
                 <label for="" class="h6">Message</label>
             </div>
             <div>
             <textarea type="text" name="message" id="" cols="50" rows="10"></textarea>
             </div>
             <div class="mt-4">
               <h4 class="text-center text-primary">Destinataires</h4>
                 <table class="table table-bordered">
                     <thead class="bg-primary text-center text-white">
                         <tr>
                             <th></th>
                             <th>#</th>
                             <th>Nom Complet</th>
                             <th>Tel</th>
                         </tr>
                     </thead>
                     <tbody class="text-center">
                     <?php foreach ($users as $u) { ?>
                    <tr>
                    <td>
                       <input type="checkbox" name="dest" value="<?= $u['idUser'] ?>">
                    </td>
                    <td><?= $u['idUser'] ?></td>
                    <td><?= $u['nomComplet'] ?></td>
                    <td><?= $u['telUser'] ?></td>
                    </tr>
                      <?php } ?>
                     </tbody>
                 </table>
             </div>
         </div>
         <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
              <button type="submit" class="btn btn-primary" name="btnEnvoyer">Envoyer</button>
         </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade " id="detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white " id="exampleModalLabel">Details du Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST">
          <div class="modal-body">
             <div class="mt-4" style="padding-left:40px;">
                 <label for="" class="h6">Objet</label>
                 <input type="text" value="" class="form-control" name="objet" id="objet" disabled>
             </div>
             <div class="mt-4" style="padding-left:40px;">
                 <label for="" class="h6">Message</label>
             </div>
             <div>
             <textarea type="text" name="message" id="message" cols="50" rows="10" disabled></textarea>
             </div>
             <div class="mt-4" style="padding-left:40px;">
                 <label for="" class="h6">Expediteur</label>
             </div>
             <div style="padding-left:40px;">
               <input type="text" class="form-control" name="exp" id="exp"  disabled>
             </div>
             <div class="mt-4" style="padding-left:40px;">
                 <label for="" class="h6">Destinataire</label>
             </div>
             <div style="padding-left:40px;">
               <input type="text" class="form-control" name="dest" id="dest" style="width:400px;" disabled>
             </div>
         </div>
         <div class="modal-footer">
              <a href="#Rep" class="btn btn-primary" name="btnRep" data-toggle = "modal">Répondre</a>
              <a href="#transfert" class="btn btn-primary" data-toggle = "modal">Transférer</a>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
         </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade " id="suppression" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title text-white " id="exampleModalLabel">Suppression du Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <form action="http://localhost/ProjetPHP/sup.php" method="POST">
            <div class="modal-body">
                <input type="hidden" id="sup" name="idS">
                <h4>Voulez vous supprimer ce message?</h4>
            </div>
            <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">NON</button>
                  <button type="submit" class="btn btn-danger" name="suppression">OUI</button>
            </div>
          </form>
    </div>
  </div>
</div>

<div class="modal fade " id="messup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title text-white " id="exampleModalLabel">Messages supprimés</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
            <div class="modal-body">
                <table class="table table-bordered" id="listeSup">
                    <thead class="bg-danger text-white text-center">
                    <tr>
                        <th>Expediteur</th>
                        <th>Destinataire</th>
                        <th>Objet</th>
                        <th>Contenu</th>
                        <th>Date et Heure</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php foreach ($messup as $msup ) { ?>
                            <tr>
                                <td><?= $msup['ex'] ?></td>
                                <td><?= $msup['des'] ?></td>
                                <td><?=$msup['objet'] ?></td>
                                <td><?= strlen($msup['contenu'])<20 ? $msup['contenu'] : substr($msup['contenu'],0,20)." ..." ?></td>
                                <td><?=$msup['date'] ?></td>
                            </tr>
                        <?php  }?>
                    </tbody>
                </table> 
            </div>
            <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
    </div>
  </div>
</div>

<div class="modal fade " id="transfert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white " id="exampleModalLabel">Transférer le message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST">
          <div class="modal-body">
             <div class="mt-4">
                 <label for="" class="h6">Objet</label>
                 <input type="text" class="form-control" name="objet" id="objettrans">
             </div>
             <div class="mt-4">
                 <label for="" class="h6">Message</label>
             </div>
             <div>
             <textarea type="text" name="message" id="messagetrans" cols="50" rows="10"></textarea>
             </div>
             <div class="mt-4">
                 <table class="table table-bordered">
                     <thead class="bg-primary text-center text-white">
                         <tr>
                             <th></th>
                             <th>#</th>
                             <th>Nom Complet</th>
                             <th>Tel</th>
                         </tr>
                     </thead>
                     <tbody class="text-center">
                     <?php foreach ($users as $u) { ?>
                    <tr>
                    <td>
                       <input type="checkbox" name="dest" value="<?= $u['idUser'] ?>">
                    </td>
                    <td><?= $u['idUser'] ?></td>
                    <td><?= $u['nomComplet'] ?></td>
                    <td><?= $u['telUser'] ?></td>
                    </tr>
                      <?php } ?>
                     </tbody>
                 </table>
             </div>
         </div>
         <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
              <button type="submit" class="btn btn-primary" name="btnTrans">Envoyer</button>
         </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade " id="Rep" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white " id="exampleModalLabel">Réponse</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST">
          <div class="modal-body">
             <div class="mt-4">
                 <label for="" class="h6">Objet</label>
                 <input type="text" value="" class="form-control" name="objet" id="objetrep" style="width:400px;" >
             </div>
             <div class="mt-4">
                 <label for="" class="h6">Message</label>
             </div>
             <div>
             <textarea type="text" name="message" id="message" cols="50" rows="10"></textarea>
             </div>
             <div class="mt-4">
               <input type="text" name="destrep" id="destrep" hidden>
             </div>
             <div class="mt-4">
               <input type="text" name="iddest" id="iddest" hidden>
             </div>
         </div>
         <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
              <button type="submit" class="btn btn-primary" name="btnRep">Envoyer</button>
         </div>
      </form>
    </div>
  </div>
</div>


</body>
<script src="http://localhost/projetPHP/public/js/jquery-3.3.1.js"></script>
<script src="http://localhost/projetPHP/public/js/bootstrap.js"></script>
<script src = "http://localhost/projetPHP/public/js/jquery.dataTables.js"></script>
<script src = "http://localhost/projetPHP/public/js/dataTables.bootstrap4.js"></script>
<script src="http://localhost/projetPHP/public/js/script.js"></script>
<script >
    $("#listeSend").dataTable();
    $("#listeRecu").dataTable();
    $("#listeSup").dataTable();
</script>
<script>
    function remplirModal(id) {
    let spanText=$(`#${id}`).text();
    let tabElement=spanText.split("~");
    $('#exp').val(tabElement[1]);
    $('#dest').val(tabElement[2]);
    $('#objet').val(tabElement[3]);
    $('#message').val(tabElement[4]);
    $('#sup').val(tabElement[0]);

    $('#objettrans').val(tabElement[3]);
    $('#messagetrans').val(tabElement[4]);
    $('#objetrep').val(tabElement[3]);
    $('#destrep').val(tabElement[1]);
    $('#iddest').val(tabElement[6]);
    }
</script>
</html>