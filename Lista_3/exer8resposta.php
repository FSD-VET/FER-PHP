<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resposta do Exercício 8</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1>Resposta do Exercício 8</h1>

    <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            try { //verificando as informações do formulario - enviadas

                $num = $_POST["num"];

                if ($num >= 1) { //verifica se o numero é maior ou igual a 1

                    echo "A contagem regressiva a partir de $num é: ";

                    $i = $num; //variavel de controle do loop - inicialização - a partir de num

                    do { //inicia o loop do-while

                        echo $i . "&nbsp;&nbsp;&nbsp;" ; // Exibe o número atual da contagem com espaçamento
                        $i--; // decremente $i a cada ciclo ($i--)

                        }

                    While ($i >= 1); //Loop continua enquanto $i for maior ou igual a 1
                    }

                    else {

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