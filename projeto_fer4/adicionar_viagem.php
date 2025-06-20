<?php
require_once("cabecalho.php"); // Inclui o cabeçalho e a conexão

$mensagem_tipo = '';
$mensagem_texto = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta os dados do formulário
    $origem = $_POST['origem'] ?? '';
    $destino = $_POST['destino'] ?? '';
    $distancia = $_POST['distancia'] ?? '';
    $data_viagem = $_POST['data_viagem'] ?? '';

    if (empty($origem) || empty($destino) || empty($distancia) || empty($data_viagem)) {
        $_SESSION['mensagem_erro'] = "Por favor, preencha todos os campos obrigatórios.";
        header("Location: adicionar_viagem.php"); 
        exit();
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO viagem (origem, destino, distancia, data_viagem) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $origem,
            $destino,
            $distancia,
            $data_viagem,
        ]);

        $_SESSION['mensagem_sucesso'] = "Viagem adicionada com sucesso!";
        header("Location: gerenciar_viagens.php");
        exit();

    } catch (PDOException $e) {
        $mensagem_tipo = 'error';
        $mensagem_texto = "Erro ao adicionar viagem: " . htmlspecialchars($e->getMessage()) . " (Código: " . $e->getCode() . ") SQLSTATE: " . $e->errorInfo[0];
    }
}

?>

<div class="container mt-4">
    <h2>Adicionar Nova Viagem</h2>

    <?php if (!empty($mensagem_texto)): ?>
    <script>
        Swal.fire({
            icon: '<?= $mensagem_tipo ?>',
            title: '<?= ($mensagem_tipo == 'success' || $mensagem_tipo == 'info') ? 'Sucesso!' : (($mensagem_tipo == 'warning') ? 'Atenção!' : 'Erro!') ?>',
            text: '<?= $mensagem_texto ?>',
            showConfirmButton: true,
            timer: false
        });
    </script>
    <?php endif; ?>

    <form action="adicionar_viagem.php" method="POST">
        <div class="mb-3">
            <label for="origem" class="form-label">Origem:</label>
            <input type="text" class="form-control" id="origem" name="origem" required maxlength="150">
        </div>
        <div class="mb-3">
            <label for="destino" class="form-label">Destino:</label>
            <input type="text" class="form-control" id="destino" name="destino" required maxlength="150">
        </div>
        <div class="mb-3">
            <label for="distancia" class="form-label">Distância (km):</label>
            <input type="number" step="0.01" class="form-control" id="distancia" name="distancia" required min="0">
        </div>
        
        <div class="mb-3">
            <label for="data_viagem" class="form-label">Data da Viagem:</label>
            <input type="date" class="form-control" id="data_viagem" name="data_viagem" required>
        </div>
        
        <button type="submit" class="btn btn-primary" style="background-color: #343a40; border-color: #343a40;">Cadastrar Viagem</button>
        <a href="gerenciar_viagens.php" class="btn btn-secondary">Voltar</a>
    </form>
</div>

<?php
require_once("rodape.php"); // Inclui o rodapé
?>