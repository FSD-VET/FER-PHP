<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resposta do Exercício 4</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1>Resposta do Exercício 4</h1>

    <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            try { //verificando as informações do formulario - enviadas
                $valorP = $_POST['valorP'];
                
                
                if ($valorP > 100) { // Para ver se os Produto custa menos que 100
                    $desconto = $valorP * (15 / 100);
                    $novoValorP = $valorP - $desconto;

                    echo "O valor do Produto era R$ " . number_format($valorP, 2, ',', '.') . ". Com o desconto de R$ " . number_format($desconto, 2, ',', '.') .", o novo valor será de R$ " . number_format($novoValorP, 2, ',', '.') . ".";
                }   
                
                //. number_format($valorP, 2, ',', '.') . para separar decinal com. e , ex: 1.250,00

                else {
                        echo "O valor do Produto é R$ ". number_format($valorP, 2, ',', '.') .". O desconto não é aplicavel para produtos com valores inferiores a R$ 100,00.";
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