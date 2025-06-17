<?php
session_start();
// vérifier que l'utilisateur est en SESSION
if(!isset($_SESSION['login'])){
    header("LOCATION:../403.php");
    exit();
}

if(isset($_GET['id']))
{
    $id = htmlspecialchars($_GET['id']);
}else{
    header("LOCATION:members.php");
    exit();
}

require "../connexion.php";
$req = $bdd->prepare("SELECT * FROM members WHERE id=?");
$req->execute([$id]);
if(!$don = $req->fetch())
{
    header("LOCATION:404.php");
    exit();
}


if(isset($_POST['login']))
{
    $err = 0;
    $statut = "all";

    if(empty($_POST['login']))
    {
        $err = 1;
    }else{
        $login = htmlspecialchars($_POST['login']);
        require "connexion.php";
        if($login != $don['login'])
        {
            $verif = $bdd->prepare("SELECT * FROM members WHERE login=?");
            $verif->execute([$login]);
            $donVerif = $verif->fetch();
            if($donVerif)
            {
                $err = 2;
            }
        }
    }

    if(empty($_POST['password']))
    {
        $statut = "uniq";
    }else{
        $password = $_POST['password'];
        $hash = password_hash($password, PASSWORD_DEFAULT);
    }

    if($err == 0)
    {
        if($statut == "all")
        {
            $update = $bdd->prepare("UPDATE members SET login=:login, password=:pass WHERE id=:myid");
            $update->execute([
                ":login" => $login,
                ":pass" => $hash,
                ':myid' => $id
            ]);
            header("LOCATION:members.php?update=".$id);
            exit();
        }else{
            $update = $bdd->prepare("UPDATE members SET login=:login WHERE id=:myid");
            $update->execute([
                ":login" => $login,
                ':myid' => $id
            ]);
            header("LOCATION:members.php?update=".$id);
            exit();
        }
    }else{
        header("LOCATION:addMember.php?error=".$err);
        exit();
    }


}else{
    header("LOCATION:addMember.php");
    exit();
}
