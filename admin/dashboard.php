<?php
session_start();
// vérifier que l'utilisateur est en SESSION
if(!isset($_SESSION['login'])){
    header("LOCATION:../403.php");
    exit();
}

if(isset($_GET['deco']))
{
    session_destroy();
    header("LOCATION:index.php");
    exit();
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
<?php
    include("partials/header.php");

?>
<div class="container">
    <h2>Tableau de bord</h2>
</div>

<?php
include("partials/footer.php");

?>
</body>
</html>