<?php 
include 'lib/php/config.php';

session_start();

session_unset();
session_destroy();

header("Location: " . $_siteUrl);

?>