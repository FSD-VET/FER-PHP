<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Frota Taxi</title> <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa; 
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .login-container {
            background-color: #ffffff; 
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .login-container img {
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #343a40; 
            border-color: #343a40;
        }
        .btn-primary:hover {
            background-color: #23272b;
            border-color: #23272b;
        }
    </style>
    </head>
  <body class="container">
    

    <?php
        
        require_once('conexao.php');
        if ($_SERVER['REQUEST_METHOD'] == "POST"){
            try{
                $email = $_POST['email'];
                $senha = $_POST['senha'];
                $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE email = ?');
                $stmt->execute([$email]);
                $usuarios = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($usuarios && password_verify($senha, $usuarios['senha'])){
                    session_start();
                    $_SESSION['usuario_nome'] = $usuarios['nome'];
                    $_SESSION['acesso'] = true;
                    $_SESSION['id'] = $usuarios['id']; //verificar como eu coloquei no banco de dados
                    header('location: principal.php'); 
                } else {
                    $mensagem['erro'] = "Usuário e/ou senha incorretos!";
                }
            } catch(Exception $e){
                echo "Erro: ".$e->getMessage();
                die();
            }
        }
    ?>

    <div class="login-container">
        <img src="logo.png" alt="Logo da Empresa" height="220" class="mb-3"> <h2 class="mb-5">Login no Sistema</h2> <?php if (isset($mensagem['erro'])): ?>
            <div class="alert alert-danger mb-3">
                <?= htmlspecialchars($mensagem['erro']) ?>
            </div>
        <?php endif; ?>

    <?php if (isset($mensagem['erro'])): ?>
        <div class="alert alert-danger mt-3 mb-3">
            <?= $mensagem['erro'] ?>
        </div>
    <?php endif; ?>

    <?php 
        if ((isset($_GET['mensagem'])) && ($_GET['mensagem'] == "acesso_negado")): ?>
        <div class="alert alert-danger mt-3 mb-3">
            Você precisa informar seus dados de acesso para acessar o sistema!
        </div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="row">
            <div class="col">
                <label for="email" class="form-label">Informe o email</label>
                <input id="email" name="email" class="form-control" type="email">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="senha" class="form-label">Informe a senha</label>
                <input id="senha" name="senha" class="form-control" type="password">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-primary mt-3">Acessar</button>
            </div>
        </div>
        <div class="row">
            <div class="col">
                Não possui acesso? Clique <a href="novo_usuario.php">aqui</a>
            </div>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>