<?php
    declare(strict_types=1); //obriga que todas as funções e variaveis tenham algum tipo definido
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista 4 - Exercício 6</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1>Lista 4 - Exercício 6</h1><br>

    <?php

        function arredondarValor(float $valor): float { //arredar valor
           
                return round($valor);// arredonda para um valor próximo
        }

       
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            try { //verificando as informações do formulario - enviadas
                $valor = (float) $_POST['valor'];//convertendo o valor para float

                $resultado = arredondarValor($valor);//arrendondando o valor 

                echo "O Valor do arrendodamento de $valor é: $resultado";
           
            } 
    
            catch(Exception $e) {  //ele armazema o erro - se existir  //$e é o pedacinho de memória que armazena o erro
                echo $e->getMessage(); //exibe o erro
            }
               
           
        }
                        
    ?>
      
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>