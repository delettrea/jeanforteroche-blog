<?php include("Vue/header.php");

require 'Autoloader.php';
Autoloader::register();

$article = new Controller();
$article->blog();


include("Vue/footer.php");

