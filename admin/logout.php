<?php
include '../config.php';
session_destroy();
header("Location:".ROOT_WWW);
?>