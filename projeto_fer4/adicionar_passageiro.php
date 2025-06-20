<?php
include_once 'cabecalho.php';

$mensagem_sucesso = ''; 
$mensagem_erro = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $endereco = $_POST['endereco'] ?? '';

    
    if (empty($nome) || empty($telefone)) {
        $_SESSION['mensagem_erro'] = "Nome e Telefone são obrigatórios.";
        header("Location: adicionar_passageiro.php"); 
        exit();
    } else {
        try {
            
            $stmt = $pdo->prepare("INSERT INTO passageiro (nome, telefone, endereco) VALUES (?, ?, ?)");
           
            if ($stmt->execute([$nome, $telefone, $endereco])) {
                $_SESSION['mensagem_sucesso'] = "Passageiro adicionado com sucesso!";
                header("Location: gerenciar_passageiro.php"); 
                exit();
            } else {
                
                $_SESSION['mensagem_erro'] = "Erro ao adicionar passageiro: " . ($stmt->errorInfo()[2] ?? 'Erro desconhecido.');
                header("Location: adicionar_passageiro.php"); 
                exit();
            }
        } catch (PDOException $e) {
            
            $_SESSION['mensagem_erro'] = "Erro de banco de dados: " . htmlspecialchars($e->getMessage());
            header("Location: adicionar_passageiro.php"); 
            exit();
        }
    }
}
?>

<div class="container">
    <h2>Adicionar Novo Passageiro</h2>

    <?php
    // Exibir mensagens de sucesso ou erro da sessão
    if (isset($_SESSION['mensagem_sucesso'])) {
        echo "<div class='alert alert-success'>" . $_SESSION['mensagem_sucesso'] . "</div>";
        unset($_SESSION['mensagem_sucesso']); // Limpa a mensagem após exibir
    }
    if (isset($_SESSION['mensagem_erro'])) {
        echo "<div class='alert alert-danger'>" . $_SESSION['mensagem_erro'] . "</div>";
        unset($_SESSION['mensagem_erro']); // Limpa a mensagem após exibir
    }
    ?>

    <form method="POST" action="adicionar_passageiro.php">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" required><br><br>

        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco"><br><br>

        <button type="submit" class="btn btn-primary" style="background-color: #343a40; border-color: #343a40;">Adicionar Passageiro</button>
        <a href="gerenciar_passageiro.php" class="btn btn-secondary">Voltar</a>
    </form>
</div>

<?php
include_once 'rodape.php';
?>