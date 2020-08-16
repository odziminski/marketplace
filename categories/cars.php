<?php
session_start();
$_SESSION['category'] = "Cars";

require '../includes/header_categories.html';
require '../add_ad.php';
