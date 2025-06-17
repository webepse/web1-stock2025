<?php
session_start();
// vérifier que l'utilisateur est en SESSION
if(!isset($_SESSION['login'])){
    header("LOCATION:../403.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Ajouter un nouveau membre</h1>
        <a href="members.php" class="btn btn-secondary my-4">Retour</a>
        <form action="treatmentAddMember.php" method="POST">
            <?php
                if(isset($_GET['error']))
                {
                    if($_GET['error'] == "2")
                    {
                        echo "<div class='alert alert-danger my-2'>Un autre membre à déjà ce login, merci d'en choisir un autre</div>";
                    }else{
                        echo "<div class='alert alert-danger my-2'>Une erreur est survenue (code erreur: ".$_GET['error']." )</div>";
                    }
                }
            ?>
            <div class="form-group my-3">
                <label for="login">Login: </label>
                <input type="text" name="login" id="login" class="form-control">
            </div>
            <div class="form-group my-3">
                <label for="password">Mot de passe: </label>
                <input type="text" name="password" id="password" class="form-control">
            </div>
            <input type="submit" value="Ajouter" class="btn btn-success">
        </form>
    </div>
</body>
</html>