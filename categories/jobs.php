<?php
session_start();
$_SESSION['category'] = "Jobs";

require '../includes/header_categories.html';
require '../add_ad.php';
