<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title><?php echo $title?></title>
    <link rel="stylesheet" href="<?php echo Url::baseUrl('assets/css/bootstrap/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?php echo Url::baseUrl('assets/css/style.css')?>">
    <script src="<?php echo Url::baseUrl('assets/js/jquery-3.3.1.min.js')?>"></script>
    <script src="<?php echo Url::baseUrl('assets/js/bootstrap/bootstrap.min.js')?>"></script>
    <script src="<?php echo Url::baseUrl('assets/js/main.js')?>"></script>
</head>
<body>
<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
    <span class="navbar-brand mb-0 h1"><img src="<?php echo Url::baseUrl('assets/images/logo-mt4-networks.jpg')?>"></span>
    <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" href="<?php echo Url::siteUrl()?>">Controle de Dispositivos <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./?action=formConnect">Integração SSH <span class="sr-only"></span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./?controller=Criptografia">Criptografia <span class="sr-only"></span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./?controller=Hash">Comparação de Hashes <span class="sr-only"></span></a>
        </li>
    </ul>
</nav>
<div class="container content">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 col-sm-12 col-xs-12">
