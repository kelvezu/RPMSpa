<!DOCTYPE html>
<html lang="en">
<?php
session_start();
require_once '../includes/security.php';
include_once '../includes/conn.inc.php';
include_once '../includes/constants.inc.php';
include_once '../classes/RPMSdb/RPMSdb.class.php';
include_once '../libraries/db.library.php';
include_once '../libraries/func.lib.php';
include_once '../includes/security.php';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Settings </title>
    <link rel="stylesheet" href="../bootstrap4/b4css/bootstrap.min.css">
    <link rel="shortcut icon" href="../img/favicon.ico">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../bootstrap4/font_awesome/css/all.css">

</head>

<body>