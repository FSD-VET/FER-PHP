<?php
    declare(strict_types=1); //obriga que todas as funções e variaveis tenham algum tipo definido
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista 4 - Exercício 3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1>Lista 4 - Exercício 3</h1><br>

    <?php

        function manipularString(string $palavra1, string $palavra2) : bool {

            return strpos($palavra1, $palavra2) !== false;// verifica (V ou F) se a 2ª palavra está contida na primeira
            // com strpos encontra a posição de uma sbtring... assim uma verificação de Verdadeiro ou Falso já dá a nossa resposta
       
        }

       
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            try { //verificando as informações do formulario - enviadas
                $palavra1 = $_POST['palavra1'];
                $palavra2 = $_POST['palavra2'];
                if (manipularString($palavra1, $palavra2)) { //chamando a função para verificar se a palavra 2 entá contida na palavra1 
                    echo "A Segunda Palavra,<strong> $palavra2</strong>, está contida na Primeira Palavra, <strong>$palavra1</strong>";
                }
                
                else {
                    echo "A Segunda Palavra, <strong> $palavra2</strong>, NÃO está contida na Primeira Palavra, <strong>$palavra1</strong>";
                }
                
  
            } 
    
            catch(Exception $e) {  //ele armazema o erro - se existir  //$e é o pedacinho de memória que armazena o erro
                echo $e->getMessage(); //exibe o erro
            }
               
           
        }
                        
    ?>
      
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>