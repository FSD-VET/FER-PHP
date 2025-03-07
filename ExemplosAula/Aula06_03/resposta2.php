<?php
    declare(strict_types=1); //obriga que todas as funções e variaveis tenham algum tipo definido
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exemplo 06-03</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1>Exemplo de uso de Função - ler Palavra</h1>

    <?php

        function manipularString(string $palavra) : void {
            echo "<p>A palavra possui ". strlen($palavra). " caracteres</p>";
            echo "<p>Letra A foi substituída por 4: " .str_replace("a", "4", $palavra). "</p>";
        }

        function gerarValorAleatorio(int $inicial, int $final) : int {// retorno do tipo int
            return rand($inicial, $final);

        }



        

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            try { //verificando as informações do formulario - enviadas
                $palavra = $_POST['palavra'];// stringval pega qualquer palavra/letra e transforma em strig
                //manipularString($palavra);
                manipularString(strtolower($palavra));//transforma tudo em minusculo

                $valor = gerarValorAleatorio(1, 20);
                echo "<p>O valor gerado foi: $valor</p>";

                $numero = 3.555555555;
                echo "<p> Mostrando duas casas decimais: " .number_format($numero, 2, ",", "."). "</p>";
            } 
    
            catch(Exception $e) {  //ele armazema o erro - se existir  //$e é o pedacinho de memória que armazena o erro
                echo $e->getMessage(); //exibe o erro
            }
               
           
        }
                        
    ?>
      
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>