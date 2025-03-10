<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista 4 - Exercício 6 (Arrendodando Valor)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>

 
    <h1><center>Lista 4 - Exercício 6 (Arrendodando Valor)<center></h1><br>



    <form method="post" action = "exer6resposta.php">
        
    <main class="container mt-3">
            
                        
    <div class="row mb-3">
            <label for="valor" class="form-label">Informe um valor de ponto flutuante (ex. 15,45 ou 1545e-2)</label>
            <input type="number" id="valor" name="valor" class="form-control" step= "0.01" inputmode="decimal" required><br><br>
        </div>
                    
                         
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>       

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>