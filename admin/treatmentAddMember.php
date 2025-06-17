<?php

if(isset($_POST['login']))
{
    $err = 0;

    if(empty($_POST['login']))
    {
        $err = 1;
    }else{
        $login = htmlspecialchars($_POST['login']);
        require "connexion.php";
        $verif = $bdd->prepare("SELECT * FROM members WHERE login=?");
        $verif->execute([$login]);
        $donVerif = $verif->fetch();
        if($donVerif)
        {
            $err = 2;
        }
    }

    if(empty($_POST['password']))
    {
        $err = 3;
    }else{
        $password = $_POST['password'];
        $hash = password_hash($password, PASSWORD_DEFAULT);
    }

    if($err == 0)
    {
        $insert = $bdd->prepare("INSERT INTO members(login,password) VALUES(:login,:pass)");
        $insert->execute([
            ":login" => $login,
            ":pass" => $hash
        ]);
        header("LOCATION:members.php?add=success");
        exit();
    }else{
        header("LOCATION:addMember.php?error=".$err);
        exit();
    }


}else{
    header("LOCATION:addMember.php");
    exit();
}
