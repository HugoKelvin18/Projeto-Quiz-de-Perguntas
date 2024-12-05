<?php
session_start();
unset($_SESSION['primeira_visita']);
session_destroy();
header("Location: index.php");
exit();
?>