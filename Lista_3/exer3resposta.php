<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resposta do Exercício 3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1>Resposta do Exercício 3</h1>

    <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            try { //verificando as informações do formulario - enviadas
                $valorA = $_POST['valorA'];
                $valorB = $_POST['valorB'];
                
                if ($valorA == $valorB) { // Para ver se os números são iguais
                    echo "Números iguais: $valorA";
                } 
                 else {
                    if ($valorA < $valorB) { // A é menor que B...então A vem 1º
                        echo "Ordem crescente: $valorA $valorB";
                    } 
                    else { // B é menor que A...então B vem 1º
                        echo "Ordem crescente: $valorB $valorA";
                    }

                        // ou (não sei se podemos usar min e max)

                //if ($valorA == $valorB) {
                    //echo "Os valores são iguais: $valorA."; 
                //}
                //else { // valores diferentes - ordenar de forma crescente
                        //$menor = min($valorA, $valorB);
                        //$maior = max($valorA, $valorB);

                        //echo "A ordem crescente dos valores é: $menor ";" $maior";
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