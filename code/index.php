<?php
include 'config.php';
require_once 'includes/functions.php'; // Use require_once to prevent multiple inclusions
include 'templates/header.html';

// Load the menu
$menu = loadMenu($mysqli);

include 'templates/index.html';
include 'footer.php'; 
?>
