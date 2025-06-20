<?php
  //include("cabecalho.php"); //dá erro e continua a abrir - menos seguro
          //ou
  //require("cabecalho.php"); //mais seguro
  require_once("cabecalho.php"); // verifica se já foi incluido anteriormente
  
  echo "<h2> Usuário: " . $_SESSION['usuario'] . "</h2>" //session_start();
?>

  <!-- <p><a href ="sair.php">Sair</a></p> -->

<?php
  require_once("rodape.php");
?>