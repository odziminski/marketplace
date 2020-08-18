<?php
require_once 'includes/header_categories.html';
require_once 'db/SelectAd.php';

$url = $_SERVER['REQUEST_URI'];
$id = substr($url, strrpos($url, '/') + 1);

$b = new SelectAdvertisement;
$b->DisplaySingleAd("
SELECT * from ads where id_ad = $id; 
");

?>