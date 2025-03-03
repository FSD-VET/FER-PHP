<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício 20 - Calculo Velocidade Média</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1>Exercício 20 - Calculo Velocidade Média</h1>

    
    <form method="post" action = "exer20resposta.php">
                        
    <div class="row mb-3">
            <label for="distancia" class="form-label">Informe a distância (km):</label>
            <input type="number" id="distancia" name="distancia" class="form-control" step= "0.01" inputmode="decimal" required>
        </div>
    
    <div class="row mb-3">
            <label for="temp" class="form-label">Informe o tempo gasto para percorrer a distância (h):</label>
            <input type="number" id="temp" name="temp" class="form-control" step= "0.01" inputmode="decimal" required>
        </div>
                         
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>       

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>