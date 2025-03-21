<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sessões</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    
    <?php


        session_start();//iniciando a sessão

        $_SESSION['usuario'] = "João";//criando uma sessão

        //        nome do cookie(variavel), valor do cookie, tempo de duração que ele vai existir em segundos
        setcookie('usuario',                'João',              time() + 3600);//criando cookie

    ?>

    <h1> Bem vindo <?= $_SESSION['usuario'] ?></h1>
    <h2> Bem vindo <?= $_COOKIE['usuario'] ?></h2>
      
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>