<?php
require_once("cabecalho.php"); // Inclui o cabeçalho com a verificação de sessão e conexão

$mensagem = '';
$viagem = null;


if (isset($_GET['id'])) {
    $idviagem = $_GET['id'];
    try {
        $stmt = $pdo->prepare("SELECT * FROM viagem WHERE idviagem = ?");
        $stmt->execute([$idviagem]);
        $viagem = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$viagem) {
            $mensagem = "<div class='alert alert-warning'>Viagem não encontrada para edição.</div>";
        }
    } catch (PDOException $e) {
        $mensagem = "<div class='alert alert-danger'>Erro ao buscar dados da viagem: " . htmlspecialchars($e->getMessage()) . "</div>";
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idviagem'])) {
    $idviagem_post = $_POST['idviagem'];
    $origem = $_POST['origem'] ?? '';
    $destino = $_POST['destino'] ?? '';
    $distancia = $_POST['distancia'] ?? '';
    $data_viagem = $_POST['data_viagem'] ?? '';

    // Validação simples
    if (empty($origem) || empty($destino) || empty($distancia) || empty($data_viagem)) {
        $mensagem = "<div class='alert alert-warning'>Por favor, preencha todos os campos obrigatórios.</div>";
    } else {
        try {
            $stmt = $pdo->prepare("UPDATE viagem SET
                origem = ?, destino = ?, distancia = ?,
                data_viagem = ?
                WHERE idviagem = ?");

            $stmt->execute([
                $origem, $destino, $distancia,
                $data_viagem,
                $idviagem_post
            ]);

            $_SESSION['mensagem_sucesso'] = "Viagem atualizada com sucesso!";
            header("Location: gerenciar_viagens.php");
            exit();

        } catch (PDOException $e) {
            $_SESSION['mensagem_erro'] = "Erro ao atualizar viagem: " . htmlspecialchars($e->getMessage());
            header("Location: gerenciar_viagens.php");
            exit();
        }
    }
}
?>

<div class="container mt-4">
    <h2>Editar Viagem</h2>

    <?php echo $mensagem; ?>

    <?php if ($viagem): ?>
    <form method="POST" action="editar_viagem.php?id=<?php echo htmlspecialchars($viagem['idviagem']); ?>">
        <input type="hidden" name="idviagem" value="<?php echo htmlspecialchars($viagem['idviagem']); ?>">

        <div class="mb-3">
            <label for="origem" class="form-label">Origem:</label>
            <input type="text" class="form-control" id="origem" name="origem" value="<?php echo htmlspecialchars($viagem['origem']); ?>" required maxlength="150">
        </div>
        <div class="mb-3">
            <label for="destino" class="form-label">Destino:</label>
            <input type="text" class="form-control" id="destino" name="destino" value="<?php echo htmlspecialchars($viagem['destino']); ?>" required maxlength="150">
        </div>
        <div class="mb-3">
            <label for="distancia" class="form-label">Distância (km):</label>
            <input type="number" step="0.01" class="form-control" id="distancia" name="distancia" value="<?php echo htmlspecialchars($viagem['distancia']); ?>" required min="0">
        </div>
        
        <div class="mb-3">
            <label for="data_viagem" class="form-label">Data da Viagem:</label>
            <input type="date" class="form-control" id="data_viagem" name="data_viagem" value="<?php echo htmlspecialchars($viagem['data_viagem']); ?>" required>
        </div>
        

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="gerenciar_viagens.php" class="btn btn-secondary">Cancelar</a>
    </form>
    <?php else: ?>
        <p>Não foi possível carregar os dados da viagem. Verifique o ID.</p>
    <?php endif; ?>
</div>

<?php
require_once("rodape.php");
?>