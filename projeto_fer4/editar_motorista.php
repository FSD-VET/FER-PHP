<?php
require_once("cabecalho.php"); // Inclui o cabeçalho com a verificação de sessão e conexão

$mensagem = '';
$motorista = null;


if (isset($_GET['id'])) {
    $idmotorista = $_GET['id'];
    try {
        $stmt = $pdo->prepare("SELECT * FROM motorista WHERE idmotorista = ?");
        $stmt->execute([$idmotorista]);
        $motorista = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$motorista) {
            $mensagem = "<div class='alert alert-warning'>Motorista não encontrado para edição.</div>";
            
        }
    } catch (PDOException $e) {
        $mensagem = "<div class='alert alert-danger'>Erro ao buscar dados do motorista: " . htmlspecialchars($e->getMessage()) . "</div>";
    }
    
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idmotorista'])) {
    $idmotorista_post = $_POST['idmotorista'];
    $nome = $_POST['nome'] ?? '';
    $numero_cnh = $_POST['numero_cnh'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $multas = $_POST['multas'] ?? '';

    if (empty($nome) || empty($numero_cnh) || empty($telefone)) {
        $mensagem = "<div class='alert alert-warning'>Por favor, preencha todos os campos obrigatórios.</div>";
    } else {
        try {
            $stmt = $pdo->prepare("UPDATE motorista SET
                nome = ?, numero_cnh = ?,
                telefone = ?, multas = ?
                WHERE idmotorista = ?");

            $stmt->execute([
                $nome, $numero_cnh, $telefone, $multas,
                $idmotorista_post
            ]);

            $_SESSION['mensagem_sucesso'] = "Motorista atualizado com sucesso!"; 
            header("Location: gerenciar_motoristas.php"); 
            exit(); 
        } catch (PDOException $e) {
            $_SESSION['mensagem_erro'] = "Erro ao atualizar motorista: " . htmlspecialchars($e->getMessage()); 
            header("Location: gerenciar_motoristas.php"); 
            exit();
        }
    }
}
?>

<div class="container mt-4">
    <h2>Editar Motorista</h2>

    <?php echo $mensagem; ?>

    <?php if ($motorista): ?>
    <form method="POST" action="editar_motorista.php?id=<?php echo htmlspecialchars($motorista['idmotorista']); ?>">
        <input type="hidden" name="idmotorista" value="<?php echo htmlspecialchars($motorista['idmotorista']); ?>">

        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($motorista['nome']); ?>" required maxlength="45">
        </div>
        
        <div class="mb-3">
            <label for="numero_cnh" class="form-label">Número CNH:</label>
            <input type="text" class="form-control" id="numero_cnh" name="numero_cnh" value="<?php echo htmlspecialchars($motorista['numero_cnh']); ?>" required maxlength="20">
        </div>
        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone:</label>
            <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo htmlspecialchars($motorista['telefone']); ?>" required maxlength="15" pattern="\(\d{2}\)\s\d{4,5}-\d{4}" placeholder="(00) 90000-0000">
        </div>
        
        <div class="mb-3">
            <label for="multas" class="form-label">Número de Multas:</label>
            <input type="number" class="form-control" id="multas" name="multas" value="<?php echo htmlspecialchars($motorista['multas']); ?>" required min="0">
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="gerenciar_motoristas.php" class="btn btn-secondary">Cancelar</a>
    </form>
    <?php else: ?>
        <p>Não foi possível carregar os dados do motorista. Verifique o ID.</p>
    <?php endif; ?>
</div>

<?php
require_once("rodape.php");
?>