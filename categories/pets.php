<?php
session_start();
$_SESSION['category'] = "Pets";

require '../includes/header_categories.html';
require '../add_ad.php';
