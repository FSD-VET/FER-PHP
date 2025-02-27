<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1>Exercício 5 - Média das Notas</h1>

    
    <form method="post" action = "exer5resposta.php">
                        
        <div class="row mb-3">
            <label for="nota1" class="form-label">Informe a primeiro nota</label>
            <input type="number" id="nota1" name="nota1" class="form-control">
        </div>
                    
        <div class="row mb-3">
            <label for="nota2" class="form-label">Informe a segundo nota</label>
            <input type="number" id="nota2" name="nota2" class="form-control">
        </div>

        <div class="row mb-3">
            <label for="nota3" class="form-label">Informe a terceira nota</label>
            <input type="number" id="nota3" name="nota3" class="form-control">
        </div>
                    
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>       

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>