<?php
session_start();
$_SESSION['category'] = "Others";

require '../includes/header_categories.html';
require '../add_ad.php';