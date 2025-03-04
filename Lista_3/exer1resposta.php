<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resposta do Exercício 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1>Resposta do Exercício 1</h1>

    <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            try { //verificando as informações do formulario - enviadas
                $num1 = $_POST['num1'];
                $num2 = $_POST['num2'];
                $num3 = $_POST['num3'];
                $num4 = $_POST['num4'];
                $num5 = $_POST['num5'];
                $num6 = $_POST['num6'];
                $num7 = $_POST['num7'];
                $menor = $num1;
                $posicao_menor = 0;

                for ($i = 0; $i < 7; $i++) { //loça de repetição para passar num por num - procurando o menor número e sua posição
                    switch ($i) {
                        case 0:
                            $valor = $num1;
                            break;
                        
                        case 1:
                            $valor = $num2;
                            break;

                        case 2:
                            $valor = $num3;
                            break;
                        
                        case 3:
                            $valor = $num4;
                            break;
                        
                        case 4:
                            $valor = $num5;
                            break;
                        
                        case 5:
                            $valor = $num6;
                            break;

                        case 6:
                            $valor = $num7;
                            break;
                                      
                    }

                    if ($valor <$menor) { //localizar o menor numero e a posição - analisada dentro do switch
                        $menor = $valor;
                        $posicao_menor = $i;
                    }
                }

                echo "O menor valor é: $menor, e a sua Posição é: $posicao_menor."; //printar o menor numero e posição
                }

            catch(Exception $e) {  //ele armazema o erro - se existir  //$e é o pedacinho de memória que armazena o erro
                echo $e->getMessage(); //exibe o erro
            }
        }

    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>