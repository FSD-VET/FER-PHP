<?php
    declare(strict_types=1); //obriga que todas as funções e variaveis tenham algum tipo definido
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista 4 - Exercício 7</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1>Lista 4 - Exercício 7</h1><br>

    <?php

        function calcularDiferenca(string $data1, string $data2): int { //calcular a difernça entre as datas
                     // convertendo as strings para DateTime - que calcula o intervalo de tempo
            $data1 = DateTime::createFromFormat('d/m/Y', $data1);// DateTime::createFromFormat - converte a data d/m/y em objeto DateTime (calcula o intervalo)
            $data2 = DateTime::createFromFormat('d/m/Y', $data2);

                    //verificando se a conversão foi feita de nodo correto
            if ($data1 == false || $data2 == false) {// se $data1 ou (||) $data2 for falso, será emitido o aviso de erro
                throw new Exception ("Formato invalido. Use o formato dd/mm/YYYY");
            }

            $intervalo = $data1 ->diff($data2);// O DIFF RETORNA UM OBJETO COM INFORMAÇÕES DA DIFERENÇA
                        // O atributo Days contém a quantidade de dias (da diferença)

            return (int) $intervalo ->days;// retorna a diferença em dias
        }

       
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            try { //verificando as informações do formulario - enviadas
                $data1 = $_POST['data1'];
                $data2 = $_POST['data2'];

                $resultado = calcularDiferenca($data1, $data2);

                echo "A diferença entre as datas $data1 e $data2 é de {$resultado} dias.";
           
            } 
    
            catch(Exception $e) {  //ele armazema o erro - se existir  //$e é o pedacinho de memória que armazena o erro
                echo $e->getMessage(); //exibe o erro
            }
     
        }
                        
    ?>
      
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>