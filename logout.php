<?php 
    session_start(); 
    unset($_SESSION['IPIZ']);
    session_destroy();
    header("Location: /");
?>
