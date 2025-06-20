<?php
include_once 'cabecalho.php';

$passageiro = null;
$mensagem = '';
$idpassageiro_get = $_GET['id'] ?? null;


if (isset($idpassageiro_get)) {
    try {
        $stmt = $pdo->prepare("SELECT idpassageiro, nome, telefone, endereco FROM passageiro WHERE idpassageiro = ?");
        $stmt->execute([$idpassageiro_get]);
        $passageiro = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$passageiro) {
            $_SESSION['mensagem_erro'] = "Passageiro não encontrado para edição.";
            header("Location: gerenciar_passageiro.php"); 
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['mensagem_erro'] = "Erro ao buscar dados do passageiro: " . htmlspecialchars($e->getMessage());
        header("Location: gerenciar_passageiro.php"); 
        exit();
    }
} else {
    $_SESSION['mensagem_erro'] = "ID do passageiro não especificado para edição.";
    header("Location: gerenciar_passageiro.php"); 
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idpassageiro'])) {
    $id = $_POST['idpassageiro'] ?? '';
    $nome = $_POST['nome'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $endereco = $_POST['endereco'] ?? '';

    if (empty($nome) || empty($telefone)) {
        $_SESSION['mensagem_erro'] = "Nome e Telefone são obrigatórios para a atualização.";
        header("Location: editar_passageiro.php?id=" . $id); 
        exit();
    } else {
        try {
            
            $stmt = $pdo->prepare("UPDATE passageiro SET nome = ?, telefone = ?, endereco = ? WHERE idpassageiro = ?");
            
            if ($stmt->execute([$nome, $telefone, $endereco, $id])) {
                $_SESSION['mensagem_sucesso'] = "Passageiro atualizado com sucesso!";
                header("Location: gerenciar_passageiro.php"); 
                exit();
            } else {
                $_SESSION['mensagem_erro'] = "Erro ao atualizar passageiro: " . ($stmt->errorInfo()[2] ?? 'Erro desconhecido.');
                header("Location: editar_passageiro.php?id=" . $id); 
                exit();
            }
        } catch (PDOException $e) {
            $_SESSION['mensagem_erro'] = "Erro de banco de dados: " . htmlspecialchars($e->getMessage());
            header("Location: editar_passageiro.php?id=" . $id); 
            exit();
        }
    }
}
?>

<div class="container">
    <h2>Editar Passageiro</h2>

    <?php
   
    if (isset($_SESSION['mensagem_sucesso'])) {
        echo "<div class='alert alert-success'>" . $_SESSION['mensagem_sucesso'] . "</div>";
        unset($_SESSION['mensagem_sucesso']);
    }
    if (isset($_SESSION['mensagem_erro'])) {
        echo "<div class='alert alert-danger'>" . $_SESSION['mensagem_erro'] . "</div>";
        unset($_SESSION['mensagem_erro']);
    }
    
    ?>

    <?php if ($passageiro): ?>
        <form method="POST" action="editar_passageiro.php?id=<?php echo $passageiro['idpassageiro']; ?>">
            <input type="hidden" name="idpassageiro" value="<?php echo $passageiro['idpassageiro']; ?>">

            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo $passageiro['nome']; ?>" required><br><br>

            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone" value="<?php echo $passageiro['telefone']; ?>" required><br><br>

            <label for="endereco">Endereço:</label>
            <input type="text" id="endereco" name="endereco" value="<?php echo $passageiro['endereco']; ?>"><br><br>

            <input type="submit" value="Atualizar Passageiro">
        </form>
    <?php elseif (!isset($_GET['id'])): ?>
        <p>ID do passageiro não especificado.</p>
    <?php endif; ?>
    <br>
    <a href="gerenciar_passageiro.php">Voltar para Gerenciar Passageiros</a>
</div>

<?php
include_once 'rodape.php';
?>