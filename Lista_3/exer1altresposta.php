<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resposta do Exercício 1 Alternativo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1>Resposta do Exercício 1 Alternativo</h1>

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

                $numeros = [$num1, $num2, $num3, $num4, $num5, $num6, $num7]; //array para os números - armazenar os dados do formulario

                $menor = $numeros[0];
                $posicao_menor = 0;

                for ($i = 0; $i < 7; $i++) { //encontrar o menor número e sua possição
                    if ($numeros[$i] < $menor) {
                        $menor = $numeros[$i]; // percorre e atualiza o menor número
                        $posicao_menor = $i;  // atualiza a posição do menor número
                                      
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