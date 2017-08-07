<?php include("Vue/header.php");

require 'Autoloader.php';
Autoloader::register();

?>

<?php

$article = new Controller();
$bio =new Controller();
$article->blog();


include("Vue/footer.php");

