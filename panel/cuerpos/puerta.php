<?php
session_start();

if($_SESSION["Rol"]<1){
  header("Location: ../index.php");
}
?>