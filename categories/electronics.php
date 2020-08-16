<?php
session_start();
$_SESSION['category'] = "Electronics";

require '../includes/header_categories.html';
require '../add_ad.php';