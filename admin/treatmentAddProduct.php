<?php

session_start();
// vérifier que l'utilisateur est en SESSION
if(!isset($_SESSION['login'])){
    header("LOCATION:../403.php");
    exit();
}

if(isset($_POST['nom']))
{

}else{
    header("LOCATION:../403.php");
}