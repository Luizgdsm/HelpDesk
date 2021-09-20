<?php 
session_start();

 if (!isset($_SESSION['validado']) && $_SESSION['validado'] != "sim") {
   header("Location: index.php?error=erro2");
 }
?>