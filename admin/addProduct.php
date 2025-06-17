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
<?php
    include("partials/header.php");
?>
<div class="container">
    <h1>Ajouter un nouveau produit</h1>
    <a href="products.php" class="btn btn-secondary my-4">Retour</a>
    <form action="treatmentAddProduct.php" method="POST" enctype="multipart/form-data">
        <?php
        if(isset($_GET['error']))
        {
            echo "<div class='alert alert-danger my-2'>Une erreur est survenue (code erreur: ".$_GET['error']." )</div>";
        }
        ?>
        <div class="form-group my-3">
            <label for="nom">Nom du produit: </label>
            <input type="text" name="nom" id="nom" class="form-control">
        </div>
        <div class="form-group my-3">
            <label for="description">Description: </label>
            <textarea name="description" id="description" rows="10" class="form-control"></textarea>
        </div>
        <div class="form-group my-3">
            <label for="date">Date: </label>
            <input type="date" name="date" id="date" class="form-control">
        </div>
        <div class="form-group my-3">
            <label for="price">Prix: </label>
            <input type="number" name="price" id="price" step="0.01" class="form-control">
        </div>
        <div class="form-group my-3">
            <label for="category">Catégorie: </label>
            <select name="categorie" id="categorie" class="form-control">
                <?php
                    require "../connexion.php";
                    /**
                     * @var PDO $bdd
                     */
                    $req = $bdd->query("SELECT * FROM categories");
                    while($don = $req->fetch()){
                        echo "<option value=".$don['id'].">".$don['nom']."</option>";
                    }
                    $req->closeCursor();
                ?>
            </select>
        </div>
        <div class="form-group my-3">
            <label for="cover">Image de couverture: </label>
            <input type="file" name="cover" id="cover" class="form-control">
        </div>
        <input type="submit" value="Ajouter" class="btn btn-success">
    </form>
</div>
<?php
include("partials/footer.php");
?>
</body>
</html>