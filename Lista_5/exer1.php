!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista 5 - Exercício 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>

 
    <h1><center>Lista 5 - Exercício 1<center></h1><br>


    <h1><center>Cadastro de Contatos<center></h1><br>


    
    <form action="exer1resposta.php" method="POST"> 

    <main class="container mt-3">

        <?php for($i=0; $i<5;$i++): ?>

            <div class="mb-3">
                <label for="nome" class="form-label">Informe o nome: </label>
                <input type="text" name="nome" placeholder="Nome" />
            </div>

            <div class="mb-3">
                <label for="tel" class="form-label">Informe o telefone: </label>
                <input type="number" name="tel" placeholder="Telefone" />
            </div>
            <br/>
        
        <?php endfor; ?>

        <button type="submit">Enviar</button>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
