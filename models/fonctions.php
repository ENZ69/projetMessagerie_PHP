<?php
require_once "BD.php";
 
function AjoutUser($nom, $login, $mdp, $tel){
    global $BD;
    return $BD->exec("INSERT INTO user (nomComplet, login, mdp, telUser) VALUES ('$nom','$login', '$mdp', '$tel' )");
}

function findUser($login, $mdp){
    global $BD;
    return $BD->query("SELECT * FROM user WHERE login = '$login' AND mdp='$mdp'") -> fetch();
}
function findDest($idDest){
    global $BD;
    return $BD->query("SELECT * FROM user WHERE idUser != '$idDest'") -> fetchAll();
}
function addMessages($ex, $exID, $des, $objet, $contenu, $idDest)
{
    global $BD;
    $objet = str_replace("'","\\\'",$objet);
    $contenu = str_replace("'","\\\'",$contenu);
    $objet = stripslashes($objet);
    $contenu = stripslashes($contenu);
    return $BD->exec("INSERT INTO message (ex, exID, des, objet, contenu, idUserF) VALUES ('$ex', '$exID','$des','$objet', '$contenu', '$idDest')");
}
function getMessages($idConect)
    {
      global $BD;
      return $BD->query("SELECT * FROM message, user WHERE user.idUser = message.idUserF AND exID = '$idConect' AND etat=1")->fetchAll();
    }
function getMess($nomConect)
    {
      global $BD;
      return $BD->query("SELECT * FROM message, user WHERE user.idUser = message.idUserF AND ex != '$nomConect' AND des = '$nomConect' AND etat=1")->fetchAll();
    }
function getSup($id)
    {
       global $BD;
       return $BD->query("SELECT * FROM message WHERE etat=0 AND exID = '$id' OR idUserF = '$id' ")->fetchAll();
    }
function findMessById($id)
    {
      global $BD;
      return $BD->query("SELECT * FROM message WHERE id = '$id'")->fetch();
    }
function deleteMess($id)
    {
      global $BD;
      return $BD->exec("UPDATE message Set etat=0 where id=$id");
      }
 function getname1($id){
   global $BD;
   return $BD->query("SELECT nomComplet FROM user WHERE idUser = '$id'")->fetch();
 }
function rep($ex, $exID, $des, $objet, $contenu, $idDest){
  global $BD;
    $objet = str_replace("'","\\\'",$objet);
    $contenu = str_replace("'","\\\'",$contenu);
    $objet = stripslashes($objet);
    $contenu = stripslashes($contenu);
    return $BD->exec("INSERT INTO message (ex, exID, des, objet, contenu, idUserF) VALUES ('$ex', '$exID','$des','$objet', '$contenu', '$idDest')");
}
?>