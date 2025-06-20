<?php
require_once("cabecalho.php"); // Inclui o cabeçalho com a verificação de sessão e conexão

$mensagem = '';
$corrida = null;


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
    $mensagem = "<div class='alert alert-danger'>Erro ao carregar dados para os formulários: " . htmlspecialchars($e->getMessage()) . "</div>";
}



if (isset($_GET['id'])) {
    $idcorrida = $_GET['id'];
    try {
        $stmt = $pdo->prepare("SELECT * FROM corrida WHERE idcorrida = ?");
        $stmt->execute([$idcorrida]);
        $corrida = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$corrida) {
            $mensagem = "<div class='alert alert-warning'>Corrida não encontrada para edição.</div>";
        }
    } catch (PDOException $e) {
        $mensagem = "<div class='alert alert-danger'>Erro ao buscar dados da corrida: " . htmlspecialchars($e->getMessage()) . "</div>";
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idcorrida'])) {
    $idcorrida_post = $_POST['idcorrida'];
    $valor_corrida = $_POST['valor_corrida'] ?? '';
    $viagem_idviagem = $_POST['viagem_idviagem'] ?? '';
    $motorista_idmotorista = $_POST['motorista_idmotorista'] ?? '';
    $veiculos_idveiculos = $_POST['veiculos_idveiculos'] ?? '';
    $passageiro_idpassageiro = $_POST['passageiro_idpassageiro'] ?? '';
    $data_corrida = $_POST['data_corrida'] ?? '';
    
    if (empty($valor_corrida) || empty($viagem_idviagem) || empty($motorista_idmotorista) || empty($veiculos_idveiculos) || empty($passageiro_idpassageiro) || empty($data_corrida)) {
        $mensagem = "<div class='alert alert-warning'>Por favor, preencha todos os campos obrigatórios.</div>";
    } else {
        try {
            $stmt = $pdo->prepare("UPDATE corrida SET
                valor_corrida = ?, viagem_idviagem = ?, motorista_idmotorista = ?,
                veiculos_idveiculos = ?, passageiro_idpassageiro = ?, data_corrida = ?
                WHERE idcorrida = ?");

            $stmt->execute([
                $valor_corrida, $viagem_idviagem, $motorista_idmotorista,
                $veiculos_idveiculos, $passageiro_idpassageiro, $data_corrida, 
                $idcorrida_post
            ]);

            $_SESSION['mensagem_sucesso'] = "Corrida atualizada com sucesso!";
            header("Location: registrar_corrida.php");
            exit();

        } catch (PDOException $e) {
            $_SESSION['mensagem_erro'] = "Erro ao atualizar corrida: " . htmlspecialchars($e->getMessage());
            header("Location: registrar_corrida.php");
            exit();
        }
    }
}
?>

<div class="container mt-4">
    <h2>Editar Corrida</h2>

    <?php echo $mensagem; ?>

    <?php if ($corrida): ?>
    <form method="POST" action="editar_corrida.php?id=<?php echo htmlspecialchars($corrida['idcorrida']); ?>">
        <input type="hidden" name="idcorrida" value="<?php echo htmlspecialchars($corrida['idcorrida']); ?>">

        <div class="mb-3">
            <label for="motorista_idmotorista" class="form-label">Motorista:</label>
            <select class="form-control" id="motorista_idmotorista" name="motorista_idmotorista" required>
                <option value="">Selecione um Motorista</option>
                <?php foreach ($motoristas as $motorista): ?>
                    <option value="<?= htmlspecialchars($motorista['idmotorista']) ?>" <?= ($motorista['idmotorista'] == $corrida['motorista_idmotorista']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($motorista['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="veiculos_idveiculos" class="form-label">Veículo:</label>
            <select class="form-control" id="veiculos_idveiculos" name="veiculos_idveiculos" required>
                <option value="">Selecione um Veículo</option>
                <?php foreach ($veiculos as $veiculo): ?>
                    <option value="<?= htmlspecialchars($veiculo['idveiculos']) ?>" <?= ($veiculo['idveiculos'] == $corrida['veiculos_idveiculos']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($veiculo['modelo']) ?> (<?= htmlspecialchars($veiculo['placa']) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="passageiro_idpassageiro" class="form-label">Passageiro:</label>
            <select class="form-control" id="passageiro_idpassageiro" name="passageiro_idpassageiro" required>
                <option value="">Selecione um Passageiro</option>
                <?php foreach ($passageiros as $passageiro): ?>
                    <option value="<?= htmlspecialchars($passageiro['idpassageiro']) ?>" <?= ($passageiro['idpassageiro'] == $corrida['passageiro_idpassageiro']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($passageiro['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="viagem_idviagem" class="form-label">Viagem (Origem - Destino):</label>
            <select class="form-control" id="viagem_idviagem" name="viagem_idviagem" required>
                <option value="">Selecione uma Viagem</option>
                <?php foreach ($viagens as $viagem): ?>
                    <option value="<?= htmlspecialchars($viagem['idviagem']) ?>" <?= ($viagem['idviagem'] == $corrida['viagem_idviagem']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($viagem['origem']) ?> - <?= htmlspecialchars($viagem['destino']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="valor_corrida" class="form-label">Valor da Corrida:</label>
            <input type="number" step="0.01" class="form-control" id="valor_corrida" name="valor_corrida" value="<?= htmlspecialchars($corrida['valor_corrida']) ?>" required min="0">
        </div>
        
        <div class="mb-3">
            <label for="data_corrida" class="form-label">Data da Corrida:</label>
            <input type="date" class="form-control" id="data_corrida" name="data_corrida" value="<?= htmlspecialchars($corrida['data_corrida']) ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="gerenciar_corridas.php" class="btn btn-secondary">Cancelar</a>
    </form>
    <?php else: ?>
        <p>Não foi possível carregar os dados da corrida. Verifique o ID.</p>
    <?php endif; ?>
</div>

<?php
require_once("rodape.php");
?>