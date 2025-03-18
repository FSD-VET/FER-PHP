<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exemplo Arrays</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>

 
    <h1><center>Exemplo na Aula do dia 13/03/2025<center></h1><br>

    <form action="exemplo_array.php" method="post">
    <main class="container mt-3">
    
        <?php for($i = 0; $i < 10; $i++): ?>
            <input type= "number" name="valor[]" placeholder="Informe o valor <?=$i ?>"/>

        <?php endfor; ?>

        <button type="submit"> Enviar </button>


        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                try { //verificando as informações do formulario - enviadas
                    $valores = $_POST['valor'];
                    echo "O primeiro valor é ".$valores[0];
                    echo "<br/>";
                    print_r($valores);//exibe os valores
                    //var_dump($valores); //Mostra tudo de uma ver e mostra o tipo dos dados (string,float,int...)
                    $valores['texto'] = 'dados';//cria uma nova posição
                    unset($valores['texto']);//exclui a posição texto
                    echo "<br/>";
                    //print_r($valores);// vê tudo de uma vez

                    foreach ($valores as $c => $v){// ou ($valores as $c => $v) - acessa e pega o valor na posição (o $c é a posição e $v é o valor)
                            echo "<p> Posição: $c - valor: $v </p>";
                    }

                    $array = [10, 11, 12, 13];
                    $array2 = array("uva", "maçã", "pêra");
                    $array3 = [
                        "uva" => 3,
                        "maçã" => 4,
                        "pêra" => 5
                        ];

                } 
        
            catch(Exception $e) {  //ele armazema o erro - se existir  //$e é o pedacinho de memória que armazena o erro
                    echo $e->getMessage(); //exibe o erro
                }
          
            }
        ?>

       

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>