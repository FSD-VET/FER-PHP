<?php
require_once("cabecalho.php"); // Inclui o cabeçalho com a verificação de sessão e conexão

$mensagem = '';
$veiculo = null;


if (isset($_GET['id'])) {
    $idveiculo = $_GET['id'];
    try {
        $stmt = $pdo->prepare("SELECT * FROM veiculos WHERE idveiculos = ?");
        $stmt->execute([$idveiculo]);
        $veiculo = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$veiculo) {
            $mensagem = "<div class='alert alert-warning'>Veículo não encontrado.</div>";
        }
    } catch (PDOException $e) {
        $mensagem = "<div class='alert alert-danger'>Erro ao buscar dados do veículo: " . htmlspecialchars($e->getMessage()) . "</div>";
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idveiculos'])) {
    $idveiculos_post = $_POST['idveiculos'];
    $placa = $_POST['placa'] ?? '';
    $modelo = $_POST['modelo'] ?? '';
    $marca = $_POST['marca'] ?? '';
    $ano_fabricacao = $_POST['ano_fabricacao'] ?? '';
    $tipo_combustivel = $_POST['tipo_combustivel'] ?? '';
    $capacidade = $_POST['capacidade'] ?? '';
    $ano_incorporacao = $_POST['ano_incorporacao'] ?? '';
    $ano_baixa = $_POST['ano_baixa'] ?? null; 

    
    if (empty($placa) || empty($modelo) || empty($marca) || empty($ano_fabricacao)) {
        $mensagem = "<div class='alert alert-warning'>Por favor, preencha todos os campos obrigatórios.</div>";
    } else {
        try {
            $stmt = $pdo->prepare("UPDATE veiculos SET 
                placa = ?, modelo = ?, marca = ?, ano_fabricacao = ?, 
                tipo_combustivel = ?, capacidade = ?, ano_incorporacao = ?, ano_baixa = ?
                WHERE idveiculos = ?");

            $stmt->execute([
                $placa, $modelo, $marca, $ano_fabricacao,
                $tipo_combustivel, $capacidade, 
                $ano_incorporacao, $ano_baixa,
                $idveiculos_post
            ]);

           $_SESSION['mensagem_sucesso'] = "Veículo atualizado com sucesso!"; 
            header("Location: gerenciar_veiculos.php"); 
            exit(); 

        } catch (PDOException $e) {
            $_SESSION['mensagem_erro'] = "Erro ao atualizar veículo: " . htmlspecialchars($e->getMessage()); 
            header("Location: gerenciar_veiculos.php"); 
            exit();
        }
    }
}
?>

<div class="container mt-4">
    <h2>Editar Veículo</h2>

    <?php echo $mensagem; ?>

    <?php if ($veiculo): ?>
    <form method="POST" action="editar_veiculo.php?id=<?php echo htmlspecialchars($veiculo['idveiculos']); ?>">
        <input type="hidden" name="idveiculos" value="<?php echo htmlspecialchars($veiculo['idveiculos']); ?>">

        <div class="mb-3">
            <label for="placa" class="form-label">Placa:</label>
            <input type="text" class="form-control" id="placa" name="placa" value="<?php echo htmlspecialchars($veiculo['placa']); ?>" required maxlength="7">
        </div>
        <div class="mb-3">
            <label for="modelo" class="form-label">Modelo:</label>
            <input type="text" class="form-control" id="modelo" name="modelo" value="<?php echo htmlspecialchars($veiculo['modelo']); ?>" required maxlength="45">
        </div>
        <div class="mb-3">
            <label for="marca" class="form-label">Marca:</label>
            <input type="text" class="form-control" id="marca" name="marca" value="<?php echo htmlspecialchars($veiculo['marca']); ?>" required maxlength="45">
        </div>
        
        <div class="mb-3">
            <label for="ano_fabricacao" class="form-label">Ano Fabricação:</label>
            <input type="number" class="form-control" id="ano_fabricacao" name="ano_fabricacao" value="<?php echo htmlspecialchars($veiculo['ano_fabricacao']); ?>" required min="1900" max="<?php echo date('Y') + 1; ?>">
        </div>
        <div class="mb-3">
            <label for="tipo_combustivel" class="form-label">Tipo Combustível:</label>
            <input type="text" class="form-control" id="tipo_combustivel" name="tipo_combustivel" value="<?php echo htmlspecialchars($veiculo['tipo_combustivel']); ?>" required maxlength="45">
        </div>
        <div class="mb-3">
            <label for="capacidade" class="form-label">Capacidade (passageiros):</label>
            <input type="number" class="form-control" id="capacidade" name="capacidade" value="<?php echo htmlspecialchars($veiculo['capacidade']); ?>" required min="1">
        </div>
        
        <div class="mb-3">
            <label for="ano_incorporacao" class="form-label">Ano de Incorporação na Frota:</label>
            <input type="number" class="form-control" id="ano_incorporacao" name="ano_incorporacao" value="<?php echo htmlspecialchars($veiculo['ano_incorporacao']); ?>" required min="1900" max="<?php echo date('Y'); ?>">
        </div>
        <div class="mb-3">
            <label for="ano_baixa" class="form-label">Ano de Baixa (opcional):</label>
            <input type="number" class="form-control" id="ano_baixa" name="ano_baixa" value="<?php echo ($veiculo['ano_baixa'] == 0 || $veiculo['ano_baixa'] === null) ? '' : htmlspecialchars($veiculo['ano_baixa']); ?>" min="1900" max="<?php echo date('Y'); ?>">
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="gerenciar_veiculos.php" class="btn btn-secondary">Cancelar</a>
    </form>
    <?php else: ?>
        <p>Não foi possível carregar os dados do veículo. Verifique o ID.</p>
    <?php endif; ?>
</div>

<?php
require_once("rodape.php");
?>