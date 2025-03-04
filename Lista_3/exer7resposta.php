<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resposta do Exercício 7</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1>Resposta do Exercício 7</h1>

    <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            try { //verificando as informações do formulario - enviadas

                $num = $_POST["num"];

                $soma = 0; //inicializa (variavel) com 0 assim a soma de 1 a ao número informado

                if ($num >= 1) { //verifica se o numero é maior ou igual a 1

                    echo "A de todos os números de 1 até $num é: ";

                    $i = 1; //variavel de controle do loop - inicialização

                    While ($i <= $num) { //Loop: soma todos os números de 1 até o número informado

                        $soma = $soma + $i; //adiciona $i a variável soma - o valor de $i é somado a variavel $soma
                        $i++; // incrementa $i para o próximo número - a cada ciclo ($i++) é incrementado em 1 até o loop chegar no número informado
                        
                    }

                    echo $soma;
                }

                    else { //se o número informado for menor que 1

                        echo "Digite um número maior ou igual a 1";
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