<?php
    declare(strict_types=1); //obriga que todas as funções e variaveis tenham algum tipo definido
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista 4 - Exercício 5</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1>Lista 4 - Exercício 5</h1><br>

    <?php

        function calcularRaiz(float $valor): float | string { //calcular raiz quadrada
            if ($valor <0) {
                return "<strong>NÃO existe</strong> raiz quadadra de valor negativo.";
            }
    
            else {
                return sqrt($valor); //Calcula e retorna a raiz Quadrada
            }
        }

       
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            try { //verificando as informações do formulario - enviadas
                $valor = (float) $_POST['valor'];//convertendo o valor para float

                $resultado = calcularRaiz($valor);//calcular a raiz 

                echo "O Valor da raiz quadrada de $valor: $resultado";
           
            } 
    
            catch(Exception $e) {  //ele armazema o erro - se existir  //$e é o pedacinho de memória que armazena o erro
                echo $e->getMessage(); //exibe o erro
            }
               
           
        }
                        
    ?>
      
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>