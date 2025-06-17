<?php
session_start();
// vérifier que l'utilisateur est en SESSION
if(!isset($_SESSION['login'])){
    header("LOCATION:../403.php");
    exit();
}

require "../connexion.php";
/**
 * @var PDO $bdd
 */

if(isset($_GET['delete']) && is_numeric($_GET['delete']))
{
    $id = htmlspecialchars($_GET['delete']);

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
    <h1>Les produits du site</h1>
    <a href="addProduct.php" class="btn btn-primary my-4">Ajouter un produit</a>
    <?php
    if(isset($_GET['add']) && $_GET['add'] == "success")
    {
        echo "<div class='alert alert-success my-2'>Vous avez bien ajouté un nouveau produit au site</div>";
    }

    if(isset($_GET['update']))
    {
        echo "<div class='alert alert-warning'>Vous avez bien modifié le produit id° ".$_GET['update']."</div>";
    }

    if(isset($success))
    {
        echo "<div class='alert alert-danger my-2'>Vous avez bien supprimé  le produit id° ".$success."</div>";
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
            <th>Catéogrie</th>
            <th>Nom</th>
            <th>Date</th>
            <th>Prix</th>
            <th>Créateur</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $req = $bdd->query("SELECT products.nom AS pnom, categories.nom AS cnom, DATE_FORMAT(products.date, '%d/%m/%Y') AS mydate, products.price AS prix, members.login AS login, members.id AS mid, products.id AS pid FROM products INNER JOIN categories ON products.id_category = categories.id INNER JOIN members ON products.id_member = members.id");
        while($don = $req->fetch())
        {
            echo "<tr>";
            echo "<td>".$don['pid']."</td>";
            echo "<td>".$don['cnom']."</td>";
            echo "<td>".$don['pnom']."</td>";
            echo "<td>".$don['mydate']."</td>";
            echo "<td>".$don['prix']."€</td>";
            echo "<td>".$don['login']."</td>";
            echo "<td>";
            echo "<a href='updateProduct.php?id=".$don['pid']."' class='btn btn-warning'>Modifier</a>";
            echo "<a href='products.php?delete=".$don['pid']."' class='btn btn-danger mx-2'>Supprimer</a>";
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