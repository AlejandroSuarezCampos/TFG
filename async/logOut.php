<?php
session_start();
session_destroy();

header("Location:/TFG/index.php");
exit;
?>