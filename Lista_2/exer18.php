<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício 18 - Calculo Juros Compostos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1>Exercício 18 - Calculo Juros Compostos</h1>

    
    <form method="post" action = "exer18resposta.php">
                        
    <div class="row mb-3">
            <label for="capital" class="form-label">Informe o Capital</label>
            <input type="number" id="capital" name="capital" class="form-control" step= "0.01" inputmode="decimal" required>
        </div>
                    
        <div class="row mb-3">
            <label for="juros" class="form-label">Informe a Taxa de Juros</label>
            <input type="number" id="juros" name="juros" class="form-control" step= "0.01" inputmode="decimal" required>
        </div>

        <div class="row mb-3">
            <label for="periodo" class="form-label">Informe o Período</label>
            <input type="number" id="periodo" name="periodo" class="form-control" step= "0.01" inputmode="decimal" required>
        </div>
                         
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>       

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>