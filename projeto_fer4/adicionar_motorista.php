<?php
require_once("cabecalho.php"); // Inclui o cabeçalho e a conexão

$mensagem_tipo = '';
$mensagem_texto = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'] ??'';
    $numero_cnh = $_POST['numero_cnh'] ??'';
    $telefone = $_POST['telefone'] ??''; 
    $multas = $_POST['multas'] ??''; 

    if (empty($nome) || empty($numero_cnh)) {
        $_SESSION['mensagem_erro'] = "Por favor, preencha todos os campos obrigatórios: Nome e CNH.";
        header("Location: adicionar_motorista.php"); 
        exit();
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO motorista (nome, numero_cnh, telefone, multas) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $nome,
            $numero_cnh, 
            $telefone,
            $multas
        ]);

        $_SESSION['mensagem_sucesso'] = "Motorista adicionado com sucesso!";
        header("Location: gerenciar_motoristas.php"); 
        exit(); 

    } catch (PDOException $e) {
            $mensagem_tipo = 'error';
            $mensagem_texto = "Erro ao adicionar veículo: " . htmlspecialchars($e->getMessage()) . " (Código: " . $e->getCode() . ") SQLSTATE: " . $e->errorInfo[0];
        }
}

?>

<div class="container mt-4">
    <h2>Adicionar Novo Motorista</h2>

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

<form action="adicionar_motorista.php" method="POST">
    <div class="mb-3">
        <label for="nome" class="form-label">Nome Completo:</label>
        <input type="text" class="form-control" id="nome" name="nome" required>
    </div>
    
    <div class="mb-3">
        <label for="numero_cnh" class="form-label">Número CNH:</label>
        <input type="text" class="form-control" id="numero_cnh" name="numero_cnh" required>
    </div>

    <div class="mb-3">
        <label for="telefone" class="form-label">Telefone:</label>
        <input type="text" class="form-control" id="telefone" name="telefone" required>
    </div>
    
    <div class="mb-3">
        <label for="multas" class="form-label">Número de Multas:</label>
        <input type="number" class="form-control" id="multas" name="multas" value="0" required>
    </div>
    <button type="submit" class="btn btn-primary" style="background-color: #343a40; border-color: #343a40;">Cadastrar Motorista</button>
    <a href="gerenciar_motoristas.php" class="btn btn-secondary">Voltar</a>
</form>

<?php
require_once("rodape.php"); // Inclui o rodapé (que fecha a conexão)
?>