<?php
session_start();

if (!isset($_SESSION['cargo'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layout Lateral em PHP</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./styles/dashboard.css">
    <link rel="stylesheet" href="styles/gerenClientes.css">
    <style>
        .content {
            padding: 20px;
            min-height: 100vh;
        }


        #main-content{
            padding-inline: 20vh;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-lg-2 sidebar bg-light">
            <nav class="nav flex-column">
                <a class="nav-link active" href="#" id="link-dashboard">Dashboard</a>
                <a class="nav-link" href="#" id="link-clientes">Gerenciar Clientes</a>
                <a class="nav-link" href="#" id="link-produtos">Gerenciar Produtos</a>
                <a class="nav-link" href="#" id="link-vendas">Realizar Vendas</a>
                <a class="nav-link" href="#" id="link-listar-vendas">Listar Vendas</a>
                <a class="nav-link" id="link-sair">Sair</a>
            </nav>
        </div>

        <div class="col-md-9 col-lg-10 content" id="main-content">
            <div id="dashboard-content" style="display: none;"><?php include_once('dash.php');?></div>
            <div id="clientes-content" style="display: none;"><?php include_once('gerenClientes.php');?></div>
            <div id="produtos-content" style="display: none;"><?php include_once('gerenProduto.php');?></div>
            <div id="vendas-content" style="display: none;"><?php include_once('venda.php');?></div>
            <div id="listar-vendas-content" style="display: none;"><?php include_once('listVenda.php');?></div>
            <div id="sair-content" style="display: none;"></div>
        </div>
    </div>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var selectedContent = localStorage.getItem("selectedContent");
        var scrollPosition = localStorage.getItem("scrollPosition");
        
        if (selectedContent) {
            showContent(selectedContent);
        }
        
        if (scrollPosition) {
            window.scrollTo(0, scrollPosition);
        }

        function showContent(contentId) {
            var contents = document.querySelectorAll('.content > div');
            contents.forEach(function(content) {
                content.style.display = 'none';
            });

            document.getElementById(contentId).style.display = 'block';
            localStorage.setItem("selectedContent", contentId);
        }

        function storeScrollPosition() {
            localStorage.setItem("scrollPosition", window.scrollY);
        }

        window.addEventListener('beforeunload', storeScrollPosition);

        document.getElementById('link-listar-vendas').addEventListener('click', function(event) {
            event.preventDefault();
            showContent('listar-vendas-content');
        });

        document.getElementById('link-dashboard').addEventListener('click', function(event) {
            event.preventDefault();
            showContent('dashboard-content');
        });

        document.getElementById('link-clientes').addEventListener('click', function(event) {
            event.preventDefault();
            showContent('clientes-content');
        });

        document.getElementById('link-produtos').addEventListener('click', function(event) {
            event.preventDefault();
            showContent('produtos-content');
        });

        document.getElementById('link-vendas').addEventListener('click', function(event) {
            event.preventDefault();
            showContent('vendas-content');
        });

        document.getElementById('link-sair').addEventListener('click', function(event) {
            event.preventDefault();
            showContent('sair-content');
            localStorage.removeItem("selectedContent");
            localStorage.removeItem("scrollPosition");
            window.location.href = 'logout.php';
        });
    });
</script>

</body>
</html>
