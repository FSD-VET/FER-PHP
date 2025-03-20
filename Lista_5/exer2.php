<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista 5 - Exercício 2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>

 
    <h1><center>Lista 5 - Exercício 2<center></h1><br>


    <h1><center>Cadastro de Alunos e Notas<center></h1><br>


    
    <form action="exer2resposta.php" method="POST"> 

    <main class="container mt-3">

        <?php for($i=0; $i<5;$i++): ?>

            <div class="mb-3">
                <label for="nome[]" class="form-label">Informe o nome: </label>
                <input type="text" name="nome[]" placeholder="Nome" />
            </div>

            <div class="mb-3">
                <label for="nota1[]" class="form-label">Informe a 1ª Nota: </label>
                <input type="number" step="0.01" name="nota1[]" placeholder="Nota de 0 a 10" />
            </div>
            <br/>

            <div class="mb-3">
                <label for="nota2[]" class="form-label">Informe a 2ª Nota: </label>
                <input type="number" step="0.01" name="nota2[]" placeholder="Nota de 0 a 10" />
            </div>
            <br/>

            <div class="mb-3">
                <label for="nota3[]" class="form-label">Informe a 3ª Nota: </label>
                <input type="number" step="0.01" name="nota3[]" placeholder="Nota de 0 a 10" />
            </div>
            <br/>
        
        <?php endfor; ?>

        <button type="submit">Enviar</button>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>