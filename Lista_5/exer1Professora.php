<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista 5 - Exercício 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>

 
    <h1><center>Lista 5 - Exercício 1<center></h1><br>


    <h1><center>XXXXXXXXXXXXXXXXXXXX<center></h1><br>


    <form method="post" action = "">
        
    <main class="container mt-3">

        <?php for($i=0; $i<5;$i++): ?>

            <input type="text" name="nome" placeholder="Nome" />
            <input type="number" name="tel" placeholder="Telefone" />
            
            <br/>
        
        <?php endfor; ?>
        <button type="submit">Enviar</button>

    </form>  
    
    <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            try { //verificando as informações do formulario - enviadas

                $a = array();
                $nome = $_POST['nome'];
                $tel = $_POST['tel'];

                for($i=0; $i<5; $i++){
                    //$posicao = $nome[$i];
                    $a[$posicao[$i]] = $tel[$i];
                }

                foreach ($a as $nome => $telefone) {
                    echo "$nome: $tel";
                }
                   
            } 
                
            } 

            catch(Exception $e) {  //ele armazema o erro - se existir  //$e é o pedacinho de memória que armazena o erro
                echo $e->getMessage(); //exibe o erro
            }

        

        ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>