<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resposta do Exercício 10</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1>Resposta do Exercício 10</h1><br>

    <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            try { //verificando as informações do formulario - enviadas

                $num = $_POST["num"];//obtem o numero informado no formulário

                echo "<p>Tabuada do número " .$num. ":</p>";

                for ($i = 1; $i <= 10; $i++) { //Loop: para calcular taboada de 1 a 10
                    //começa em $i =1 e vai até $i <= 10 (condição de parada do loop - enquanto $i for menor ou igual a 10)
                    //e incrementa ($i++) 1 a cada ciclo

                    $resultado = $num * $i;//multiplica o número pela interação

                    echo "<p>". $num . " X " . $i . " = " . $resultado ."</p>";// dentro da string ("") temos que utilizar .$num. para exiber, neste caso, linha a linha (paragrafo)


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