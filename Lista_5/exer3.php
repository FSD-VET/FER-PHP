<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista 5 - Exercício 3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>

 
    <h1><center>Lista 5 - Exercício 3<center></h1><br>


    <h1><center>Cadastro de Produtos<center></h1><br>


    
    <form action="exer3resposta.php" method="POST"> 

    <main class="container mt-3">

        <?php for($i=0; $i<5;$i++): ?>

            <div class="mb-3">
                <label for="codigo[]" class="form-label">Informe o Código do Produto: </label>
                <input type="number" name="codigo[]" />
            </div>

            <div class="mb-3">
                <label for="nome[]" class="form-label">Informe o Nome do Produto: </label>
                <input type="text" name="nome[]"/>
            </div>
            <br/>

            <div class="mb-3">
                <label for="valor[]" class="form-label">Informe o valor do Produto: </label>
                <input type="number" step="0.01" name="valor[]" />
            </div>
            <br/>
        
        <?php endfor; ?>

        <button type="submit">Enviar</button>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>