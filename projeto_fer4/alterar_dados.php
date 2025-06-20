<?php
    require_once('cabecalho.php'); 
    require_once('conexao.php'); 

    
    function retornaDadosUsuario($pdo) { 
        

        try {
            $sql = "SELECT * FROM usuarios WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$_SESSION['id']]);
            $usuarios = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$usuarios) {
                die("Erro ao consultar o usuário");
            } else {
                return $usuarios;
            }
        } catch (Exception $e) {
            die("Erro ao consultar o usuário: ".$e->getMessage());
        }
    }

    
    function alterarDadosUsuario($pdo, $nome, $email) { 
        
        try {
            $sql = "UPDATE usuarios SET nome =?, email = ? WHERE id = ?"; 
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$nome, $email, $_SESSION['id']])) {
                $_SESSION['usuarios'] = $nome; 
                return "<p class='text-success'>Dados alterados com sucesso! Você será redirecionado para o login.</p>"; 
            } else {
                return "<p class='text-danger'>Erro ao alterar dados!</p>"; 
            }

        }catch (Exception $e) {
            return "Erro ao alterar dados do usuário: ".$e->getMessage(); 
        }
    }

    
    function alterarSenha($pdo, $senhaAntiga, $novaSenha, $novaSenhaConfirm) { 
        
        try {
            if ($novaSenha == $novaSenhaConfirm) {
                $usuarios = retornaDadosUsuario($pdo); 
                if ($usuarios && password_verify($senhaAntiga, $usuarios['senha'])) { 
                    $sql = "UPDATE usuarios SET senha = ? WHERE id = ?";
                    $stmt = $pdo->prepare($sql);
                    $novaSenhaHashed = password_hash($novaSenha, PASSWORD_BCRYPT); 
                    if ($stmt->execute([$novaSenhaHashed, $_SESSION['id']])){
                        return "<p class='text-success'>Senha alterada com sucesso! Você será redirecionado para o login.</p>"; 
                    } else {
                        return "<p class='text-danger'>Erro ao alterar senha!</p>"; 
                    }
                } else {
                    return "<p class='text-danger'>Senha antiga incorreta!</p>"; 
                }
            } else {
                return "<p class='text-danger'>Senhas não conferem!</p>"; 
            }

        }catch (Exception $e) {
            return "Erro ao alterar senha: ".$e->getMessage(); 
        }
    }

    $mensagem = ''; 

    
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['nome']) && isset($_POST['email'])) {
            $mensagem = alterarDadosUsuario($pdo, $_POST['nome'], $_POST['email']); 
            header("Refresh: 1; url=index.php"); 
            exit(); 
        } else if (isset($_POST['nova_senha'])) { 
            $mensagem = alterarSenha($pdo, $_POST['senha_antiga'], $_POST['nova_senha'], $_POST['nova_senha_confirm']);            
            header("Refresh: 1; url=sair.php"); 
            exit(); 
        }
    }

    
    $usuarios = retornaDadosUsuario($pdo); 
?>

<h3>Alteração de dados pessoais</h3>

<?php if (!empty($mensagem)): ?>
    <div class="alert mt-3 mb-3">
        <?= $mensagem ?>
    </div>
<?php endif; ?>

<form method="post">
                        
    <div class="mb-3">
        <label for="nome" class="form-label">Nome do Usuário</label>
        <input value="<?= htmlspecialchars($usuarios['nome']) ?>" type="text" id="nome" name="nome" class="form-control" required="">
    </div>
                    
    <div class="mb-3">
        <label for="email" class="form-label">Emaildo usuário</label>
        <input value="<?= htmlspecialchars($usuarios['email']) ?>" type="email" id="email" name="email" class="form-control" required="">
    </div>
                    
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>

<h3>Alteração da Senha</h3>


<form method="post">
                        
    <div class="mb-3">
        <label for="senha_antiga" class="form-label">Informe a senha antiga</label>
        <input type="password" id="senha_antiga" name="senha_antiga" class="form-control" required="">
    </div>
                    
    <div class="mb-3">
        <label for="nova_senha" class="form-label">Informe a nova senha</label>
        <input type="password" id="nova_senha" name="nova_senha" class="form-control" required="">
    </div>
                    
    <div class="mb-3">
        <label for="nova_senha_confirm" class="form-label">Repita a nova senha</label>
        <input type="password" id="nova_senha_confirm" name="nova_senha_confirm" class="form-control" required="">
    </div>
                    
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>
            
            
<?php
    require_once("rodape.php");
?>