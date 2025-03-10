<?php
    declare(strict_types=1); //obriga que todas as funções e variaveis tenham algum tipo definido
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista 4 - Exercício 4</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1>Lista 4 - Exercício 4</h1><br>

    <?php

        function validarData(int $dia, int $mes, int $ano): bool { //verifica se a data é válida
    
            return checkdate($mes, $dia, $ano); //checkdate - verifica a validade de uma data (dia,mês,ano)
        }


        function formatarData(int $dia, int $mes, int $ano): string {
    
            $timestamp = mktime(0, 0, 0, $mes, $dia, $ano);//Obtendo o timestamp - dd/mm/yyyy
            //mktime obtém este timestamp para a data e/ou hora
    
            return date("d/m/Y", $timestamp);// formatando a data
        }

       
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            try { //verificando as informações do formulario - enviadas
                $dia = (int) $_POST['dia'];
                $mes = (int) $_POST['mes'];
                $ano = (int) $_POST['ano'];
                
                if (validarData($dia, $mes, $ano)) { //chamando a função para verificar data
                   
                    echo "A data informada é: " . formatarData($dia, $mes, $ano);//se válido, exibe a data

                } 
                
                else {
            
                    echo "A data informada não é válida.";// Não válida - exibe mensagem de erro

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