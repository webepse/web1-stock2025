<?php
    session_start();

    // pour éviter qu'un utilisateur déjà connecté passe sur cette page de connexion
    if(isset($_SESSION['login'])){
        header("LOCATION:dashboard.php");
        exit();
    }


    // vérifier l'envoie du formulaire de connexion
    if(isset($_POST['login']) && isset($_POST['password'])){

        // vérifier si le formulaire est correctement remplis
        if(empty($_POST['login']) || empty($_POST['password'])){
            // affichage d'une erreur
            $erreur = "Veuillez remplir tous les champs";
        }else{
            require "../connexion.php";
            $login = htmlspecialchars($_POST['login']);
            /**
             * @var PDO $bdd
             */
            $req = $bdd->prepare("SELECT * FROM members WHERE login = ?");
            $req->execute([$login]);
            $don = $req->fetch(PDO::FETCH_ASSOC);
            $req->closeCursor(); // pas obligatoire
            if($don){
                // correspondance dans la bdd
                // test du mot de passe associé au login
                if(password_verify($_POST['password'], $don['password']))
                {
                    $_SESSION['login'] = $don['login'];
                    $_SESSION['id'] = $don['id'];
                    header("LOCATION:dashboard.php");
                    exit();
                }else{
                    $erreur = "Login ou mot de passe est incorrect";
                }

            }else{
                $erreur = "Login ou mot de passe incorrect";
            }
        }

    }

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
    <title>Administration - Stock 2025</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 mt-5">
                <form action="index.php" method="POST">
                    <h2>Connexion à l'administration</h2>
                    <?php
                        if(isset($erreur)){
                            echo '<div class="alert alert-danger">'.$erreur.'</div>';
                        }
                    ?>
                    <div class="form-group my-3">
                        <label for="login">Login: </label>
                        <input type="text" name="login" id="login" class="form-control">
                    </div>
                    <div class="form-group my-3">
                        <label for="password">Mot de passe: </label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <input type="submit" value="Connexion" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>

</body>
</html>