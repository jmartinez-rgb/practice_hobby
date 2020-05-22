<?php
session_start();
if($_SESSION['user'] != '2'){
    header('Location: index.php');
    exit();
}