<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resposta do Exercício 9</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1>Resposta do Exercício 9</h1><br>

    <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            try { //verificando as informações do formulario - enviadas

                $num = $_POST["num"];

                if ($num < 0) { //verifica se o numero é positivo

                    echo "Insira um número positico";

                }

                else {

                    $fatorial = 1; //inicializa varialvel com 1 (fatorial de 0 e 1 é 1)

                    for ($i = 1; $i <= $num; $i++){ //Loop: para calcular o fatorial
                        //começa em $i =1 e vai até $i <= $num (condição de parada do loop - enquanto $i for menor ou igual a $num)
                        //e incrementa ($i++) 1 a cada ciclo

                        $fatorial = $fatorial * $i; //multiplicação da variavel fatorial pelo iteração (a cada rodada)
                        //ex: $i = 1 - temos: $fatorial = 1 * 1 = 1; $i = 2 - temos: $fatorial = 1 * 2 = 2....
                        //até chegar a $i <= $num
                        }
                    
                    echo "O Fatorial de $num é: $fatorial";

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