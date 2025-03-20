<?php
    declare(strict_types=1); //obriga que todas as funções e variaveis tenham algum tipo definido
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista 5 - Exercício 4</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1>Lista 5 - Exercício 4</h1>
    <br>
    <br>

    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    
        try { //verificando as informações do formulario - enviadas

            $itens = array();//inicia um array para armazenar os produtos
                
            $nomes = $_POST['nome']; 
            $preco = $_POST['preco'];
    
            for ($i = 0; $i < 5; $i++) {//loop para os 5 produtos
                    //array para cada item - armazenando cada informação com o seu item
                $nome = $nomes[$i];
                $novoPreco = floatval($preco[$i]);

                // Aplica o imposto de 15% no preço
                $novoPreco = $novoPreco * 1.15;
                $itens[$nome] = $novoPreco;

                }

                asort($itens);//ordem crescente de acordo com os valores

                echo "<h2>Lista de Itens</h2>";
                echo "<ul>";
                foreach ($itens as $nome => $novoPreco) {//exibe os dados de cada produto
                    echo "<li><strong>" . $nome . "</strong>:  Preço: R$ " . number_format($novoPreco, 2, ',', '.') . "</li>";
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