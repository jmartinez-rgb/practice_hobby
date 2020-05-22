<?php
session_start();
if($_SESSION['identificador'] != '2'){
    header('Location: index.php');
    exit();
}
