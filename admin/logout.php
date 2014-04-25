<?php
session_start();
session_destroy();
header("location:login.php");//redirect page to session.php
?>