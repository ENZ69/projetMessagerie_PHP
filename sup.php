<?php
require_once "models/fonctions.php";
if(isset($_POST['suppression']))
    {
        extract($_POST);
        deleteMess($idS);
        header("location:http://localhost/projetPHP/acceuil.php");
    }
?>