<?php
session_start();
if($_SESSION['identificador'] != '1'){
    header('Location: index.php');
    exit();
}
