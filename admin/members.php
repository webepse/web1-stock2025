<?php
    session_start();
    // vérifier que l'utilisateur est en SESSION
    if(!isset($_SESSION['login'])){
        header("LOCATION:../403.php");
        exit();
    }

    require "../connexion.php";

    if(isset($_GET['delete']) && is_numeric($_GET['delete']))
    {
        $id = htmlspecialchars($_GET['delete']);
        if($id != $_SESSION['id'] && $id != 1){
            $verif = $bdd->prepare("SELECT * FROM members WHERE id=?");
            $verif->execute([$id]);
            if(!$don = $verif->fetch())
            {
               $erreur = "Le membre n'existe pas";
            }else{
                $delete = $bdd->prepare("DELETE FROM members WHERE id=?");
                $delete->execute([$id]);
                $success = $id;
/*                header("LOCATION:members.php?mydelete=".$id);
                exit();*/
            }

        }else{
            $erreur = "Vous ne pouvez pas supprimer cet utilisateur";
        }
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
        <h1>Les membres du site</h1>
        <a href="addMember.php" class="btn btn-primary my-4">Ajouter un membre</a>
        <?php
             if(isset($_GET['add']) && $_GET['add'] == "success")
                {
                    echo "<div class='alert alert-success my-2'>Vous avez bien ajouté un nouveau membre au site</div>";
                }

            if(isset($_GET['update']))
            {
                echo "<div class='alert alert-warning'>Vous avez bien modifié le membre id° ".$_GET['update']."</div>";
            }

             if(isset($success))
                {
                    echo "<div class='alert alert-danger my-2'>Vous avez bien supprimé  le membre id° ".$success."</div>";
                }

             if(isset($erreur))
             {
                 echo "<div class='alert alert-danger my-2'>".$erreur."</div>";
             }
        ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Login</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $req = $bdd->query("SELECT * FROM members");
                    while($don = $req->fetch())
                    {
                        echo "<tr>";
                            echo "<td>".$don['id']."</td>";
                            echo "<td>".$don['login']."</td>";
                            echo "<td>";
                                echo "<a href='updateMember.php?id=".$don['id']."' class='btn btn-warning'>Modifier</a>";
                                echo "<a href='members.php?delete=".$don['id']."' class='btn btn-danger mx-2'>Supprimer</a>";
                            echo "</td>";
                        echo "</tr>";
                    }
                    $req->closeCursor();
                ?>
            </tbody>    
        </table>
    </div>
</body>
</html>