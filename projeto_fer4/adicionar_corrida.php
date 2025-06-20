<?php
require_once("cabecalho.php"); // Inclui o cabeçalho e a conexão

$mensagem_tipo = '';
$mensagem_texto = '';

// Carregar dados para os dropdowns
$motoristas = [];
$veiculos = [];
$viagens = [];
$passageiros = [];

try {
    $stmt = $pdo->query("SELECT idmotorista, nome FROM motorista ORDER BY nome");
    $motoristas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $pdo->query("SELECT idveiculos, modelo, placa FROM veiculos ORDER BY modelo");
    $veiculos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $pdo->query("SELECT idviagem, origem, destino FROM viagem ORDER BY idviagem DESC");
    $viagens = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $pdo->query("SELECT idpassageiro, nome FROM passageiro ORDER BY nome");
    $passageiros = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $mensagem_tipo = 'error';
    $mensagem_texto = "Erro ao carregar dados para os formulários: " . htmlspecialchars($e->getMessage());
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valor_corrida = $_POST['valor_corrida'] ?? '';
    $viagem_idviagem = $_POST['viagem_idviagem'] ?? '';
    $motorista_idmotorista = $_POST['motorista_idmotorista'] ?? '';
    $veiculos_idveiculos = $_POST['veiculos_idveiculos'] ?? '';
    $passageiro_idpassageiro = $_POST['passageiro_idpassageiro'] ?? '';
    $data_corrida = $_POST['data_corrida'] ?? '';

    if (empty($viagem_idviagem) || empty($motorista_idmotorista) || empty($veiculos_idveiculos) || empty($passageiro_idpassageiro) || empty($data_corrida) ) {
        $_SESSION['mensagem_erro'] = "Por favor, preencha todos os campos obrigatórios.";
        header("Location: adicionar_corrida.php"); 
        exit();
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO corrida (valor_corrida, viagem_idviagem, motorista_idmotorista, veiculos_idveiculos, passageiro_idpassageiro, data_corrida) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $valor_corrida,
            $viagem_idviagem,
            $motorista_idmotorista,
            $veiculos_idveiculos,
            $passageiro_idpassageiro,
            $data_corrida,
           
        ]);

        $_SESSION['mensagem_sucesso'] = "Corrida adicionada com sucesso!";
        header("Location: registrar_corrida.php");
        exit();

    } catch (PDOException $e) {
        $mensagem_tipo = 'error';
        $mensagem_texto = "Erro ao adicionar corrida: " . htmlspecialchars($e->getMessage()) . " (Código: " . $e->getCode() . ") SQLSTATE: " . $e->errorInfo[0];
    }
}

?>

<div class="container mt-4">
    <h2>Adicionar Nova Corrida</h2>

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

    <form action="adicionar_corrida.php" method="POST">
        <div class="mb-3">
            <label for="motorista_idmotorista" class="form-label">Motorista:</label>
            <select class="form-control" id="motorista_idmotorista" name="motorista_idmotorista" required>
                <option value="">Selecione um Motorista</option>
                <?php foreach ($motoristas as $motorista): ?>
                    <option value="<?= htmlspecialchars($motorista['idmotorista']) ?>"><?= htmlspecialchars($motorista['nome']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="veiculos_idveiculos" class="form-label">Veículo:</label>
            <select class="form-control" id="veiculos_idveiculos" name="veiculos_idveiculos" required>
                <option value="">Selecione um Veículo</option>
                <?php foreach ($veiculos as $veiculo): ?>
                    <option value="<?= htmlspecialchars($veiculo['idveiculos']) ?>"><?= htmlspecialchars($veiculo['modelo']) ?> (<?= htmlspecialchars($veiculo['placa']) ?>)</option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="passageiro_idpassageiro" class="form-label">Passageiro:</label>
            <select class="form-control" id="passageiro_idpassageiro" name="passageiro_idpassageiro" required>
                <option value="">Selecione um Passageiro</option>
                <?php foreach ($passageiros as $passageiro): ?>
                    <option value="<?= htmlspecialchars($passageiro['idpassageiro']) ?>"><?= htmlspecialchars($passageiro['nome']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="viagem_idviagem" class="form-label">Viagem (Origem - Destino):</label>
            <select class="form-control" id="viagem_idviagem" name="viagem_idviagem" required>
                <option value="">Selecione uma Viagem</option>
                <?php foreach ($viagens as $viagem): ?>
                    <option value="<?= htmlspecialchars($viagem['idviagem']) ?>"><?= htmlspecialchars($viagem['origem']) ?> - <?= htmlspecialchars($viagem['destino']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="valor_corrida" class="form-label">Valor da Corrida:</label>
            <input type="number" step="0.01" class="form-control" id="valor_corrida" name="valor_corrida" required min="0">
        </div>
        
        <div class="mb-3">
            <label for="data_corrida" class="form-label">Data da Corrida:</label>
            <input type="date" class="form-control" id="data_corrida" name="data_corrida" required>
        </div>
        
        <button type="submit" class="btn btn-primary" style="background-color: #343a40; border-color: #343a40;">Registrar Corrida</button>
        <a href="registrar_corrida.php" class="btn btn-secondary">Voltar</a>
    </form>
</div>

<?php
require_once("rodape.php"); // Inclui o rodapé
?>