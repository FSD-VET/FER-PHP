<?php
  session_start();
  require_once("conexao.php");
  if(!$_SESSION['acesso']){
    header("location: index.php?mensagem=acesso_negado");
    exit();
  }
?>

<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Controle de Frota de Taxi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .navbar-dark {
            background-color: #343a40; 
        }
        .navbar-brand {
            display: flex;
            align-items: center;
        }
        .navbar-brand img {
            margin-right: 10px;
        }
        .nav-link {
            color: #f8f9fa !important; 
        }
        .nav-link:hover {
            color: #cccccc !important;
        }
        .dropdown-menu {
            background-color:rgb(55, 52, 64);
            border: 1px solid #222;
        }
        .dropdown-item {
            color: #f8f9fa;
        }
        .dropdown-item:hover {
            background-color: #222;
            color: #fff;
        }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="principal.php"><img src="logo2.png" alt="Logo da Empresa" width="auto" height="45" class="d-inline-block align-text-top me-2">Frota de Taxi</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="dashboard.php">Início</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="gerenciar_veiculos.php">Gerenciar Veículos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="gerenciar_motoristas.php">Gerenciar Motoristas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="gerenciar_passageiro.php">Gerenciar Passageiros</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="gerenciar_viagens.php">Gerenciar Viagens</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="registrar_corrida.php">Gerenciar Corrida</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="relatorio.php">Relatórios</a>
            </li>
          </ul>
          <div class="d-flex">
          <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?php
                if (isset($_SESSION['usuarios'])) {
                    echo htmlspecialchars($_SESSION['usuarios']); 
                } else {
                    echo "Usuário"; 
                }
                ?>
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="alterar_dados.php">Alterar Dados</a></li>
                <li><a class="dropdown-item btn btn-danger" href="sair.php" id="logoutButton">Sair</a></li>
              </ul>
            </li>
          </ul>
          </div>
        </div>
      </div>
    </nav>

    <main class="container">