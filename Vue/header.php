<?php
session_start();
ob_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css" />
    <link href="https://fonts.googleapis.com/css?family=Abel|Amatic+SC|Poiret+One|Quicksand" rel="stylesheet">
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
    <title>Blog</title>
</head>

<body>

<header>
    <div class="nav">
        <div>
            <a class="header" href="index.php"><h1>Billet simple pour l'Alaska</h1></a>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="index.php?action=about">About</a></li>
                <li><a href="index.php?action=contact">Contact</a></li>
            </ul>
        </nav>
    </div>
    <div class="sizeBlog">
        <a href="index.php"><img src="img/test2.jpg" alt="blog" /></a>
    </div>
</header>
<div <?php  if(isset($_SESSION['authorization_user'])){ echo 'class="adminPage"'; } elseif(isset($_GET['action'])){ echo 'class="action"'; }else{ echo 'class="page"'; }  ?> >