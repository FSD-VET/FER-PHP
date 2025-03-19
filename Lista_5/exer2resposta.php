<?php
    declare(strict_types=1); //obriga que todas as funções e variaveis tenham algum tipo definido
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista 5 - Exercício 2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1>Lista 5 - Exercício 2</h1>

    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    
        try { //verificando as informações do formulario - enviadas

            $notas = array();//inicia um array para armazenar os contatos

            $nomes = $_POST['nome']; 
            $nota1 = $_POST['nota1'];
            $nota2 = $_POST['nota2'];
            $nota3 = $_POST['nota3'];

            //var_dump($nomes, $nota1, $nota2, $nota3); verificar se está chegando os dados do formulário

            for($i=0; $i<5; $i++){//loop de 5 contatos
                $nome = $nomes[$i];
                $nota1Value = $nota1[$i];//armazena o valor de $nota1 na posição[$i]
                $nota2Value = $nota2[$i];
                $nota3Value = $nota3[$i];

                $media = ($nota1Value + $nota2Value + $nota3Value) / 3;
                $notas[$nome] = $media; 
            }   

           
            arsort($notas);//ordenando os alunos pela média - do maior para o menor

            echo "<h3>Alunos Ordenados pela Média</h3>";
            echo "<ul>";//lista ordenada
            foreach ($notas as $nome => $media) {
                echo "<li><strong>Nome:</strong> $nome - Média: ".number_format($media,2). "</li>";
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