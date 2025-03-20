<?php
    declare(strict_types=1); //obriga que todas as funções e variaveis tenham algum tipo definido
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista 5 - Exercício 5</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1>Lista 5 - Exercício 5</h1>
    <br>
    <br>

    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    
        try { //verificando as informações do formulario - enviadas

            $livros = array();//inicia um array para armazenar os produtos
                
            $nomes = $_POST['nome']; 
            $qtdes = $_POST['qtde'];

            //echo "<pre>";
            //print_r($qtdes); // Exibe os valores das quantidades recebidas
            //echo "</pre>";
    
            for ($i = 0; $i < 5; $i++) {//loop para os 5 produtos
                    //array para cada produto - armazenando cada informação com o seu produto
                $nome = $nomes[$i];
                $qtde = (int) $qtdes[$i];

                //echo "Nome: $nome - Quantidade: $qtde<br>"; teste que leitura

                $livros[$nome] = $qtde;

                }

                ksort($livros);

                echo "<h2>Lista de livros</h2>";
                echo "<ul>";
                foreach ($livros as $nome => $qtde) {//exibe os dados de cada produto
                    if ($qtde < 5) {
                        echo "<li><strong>Título: " . $nome . " --  Estoque baixo!!</strong> ($qtde unidades em estoque) </li>";
                    }
                    else {
                        echo "<li><strong>Título: " . $nome . "</strong>:  $qtde unidades em estoque </li>";
                    }
                }
                echo "</ul>";
            }

        catch(Exception $e) {  //ele armazema o erro - se existir  //$e é o pedacinho de memória que armazena o erro
            echo $e->getMessage(); //exibe o erro
        }
  
    }
                   
    ?>
      
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>