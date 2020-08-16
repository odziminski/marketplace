<?php
session_start();
$_SESSION['category'] = "House and garden";

require '../includes/header_categories.html';
require '../add_ad.php';
