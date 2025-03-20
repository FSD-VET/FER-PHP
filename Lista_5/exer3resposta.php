<?php
    declare(strict_types=1); //obriga que todas as funções e variaveis tenham algum tipo definido
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista 5 - Exercício 3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1>Lista 5 - Exercício 3</h1>
    <br>
    <br>

    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    
        try { //verificando as informações do formulario - enviadas

            $produtos = array();//inicia um array para armazenar os produtos

            //if (isset($_POST['codigo'], $_POST['nome'], $_POST['valor'])) {//verifica se os dados foram enviados
            //eu estava com problemas e fiz isso para ter certeza que não era o formulário - fica a dica
                $codigo = $_POST['codigo'];
                $nome = $_POST['nome']; 
                $valor = $_POST['valor'];
    
                for ($i = 0; $i < 5; $i++) {//loop para os 5 produtos
                    //array para cada produto - armazenando cada informação com o seu produto
                    $produto = ['codigo' => $codigo[$i], 'nome' => $nome[$i], 'preco' => floatval($valor[$i])];

                // Aplica o desconto de 10% se o preço for maior que R$100,00
                    if ($produto['preco'] >= 100) {
                        $produto['preco'] = $produto['preco'] * 0.90;  // desconto de 10% ao preço
                    }
                
                    $produtos[] = $produto;// adiciona o "produto final - com desconto" ao vetor para apresentação

                }

                uasort($produtos, function ($a, $b) {//ordena os produtos com base na comparação $a, $b - (recebe os produtos e compara os nomes)
                    return strcmp($a['nome'], $b['nome']);//usado para ordenar os produtos de forma crescente (de acordo com o nome)
                });

                echo "<h2>Lista de Produtos</h2>";
                echo "<ul>";
                foreach ($produtos as $produto) {//exibe os dados de cada produto
                    echo "<li><strong>" . $produto['nome'] . "</strong>: Código: " . $produto['codigo'] . "; Preço: R$ " . number_format($produto['preco'], 2, ',', '.') . "</li>";
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