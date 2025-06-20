<?php
require_once("cabecalho.php"); // Inclui o cabeçalho e a conexão

$mensagem_tipo = '';
$mensagem_texto = '';


if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        
    $placa = $_POST['placa'] ?? '';
    $modelo = $_POST['modelo'] ?? '';
    $marca = $_POST['marca'] ?? '';
    $ano_fabricacao = $_POST['ano_fabricacao'] ?? '';
    $tipo_combustivel = $_POST['tipo_combustivel'] ?? '';
    $capacidade = $_POST['capacidade'] ?? '';
    $ano_incorporacao = $_POST['ano_incorporacao'] ?? '';
    $ano_baixa = $_POST['ano_baixa'] ?? null; 

        try {
            $stmt = $pdo->prepare("INSERT INTO veiculos (placa, modelo, marca, ano_fabricacao, tipo_combustivel, capacidade, ano_incorporacao, ano_baixa) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $placa, $modelo, $marca, $ano_fabricacao,
                $tipo_combustivel, $capacidade, $ano_incorporacao, $ano_baixa
            ]);

            $_SESSION['mensagem_sucesso'] = "Veículo adicionado com sucesso!";
            header("Location: gerenciar_veiculos.php");
            exit();
            

        } catch (PDOException $e) {
            $mensagem_tipo = 'error';
            $mensagem_texto = "Erro ao adicionar veículo: " . htmlspecialchars($e->getMessage()) . " (Código: " . $e->getCode() . ") SQLSTATE: " . $e->errorInfo[0];
        }
    }

?>

<div class="container mt-4">
    <h2>Adicionar Novo Veículo</h2>

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

<form method="POST" action="adicionar_veiculo.php">
    <div class="mb-3">
        <label for="placa" class="form-label">Placa (Ex: ABC1D23):</label>
        <input type="text" class="form-control" id="placa" name="placa" pattern="[A-Z]{3}[0-9][A-Z0-9][0-9]{2}" title="Formato ABC1D23 ou AAA1234" required>
    </div>
    <div class="mb-3">
        <label for="modelo" class="form-label">Modelo:</label>
        <input type="text" class="form-control" id="modelo" name="modelo" required>
    </div>
    <div class="mb-3">
        <label for="marca" class="form-label">Marca:</label>
        <input type="text" class="form-control" id="marca" name="marca" required>
    </div>
    
    <div class="mb-3">
        <label for="ano_fabricacao" class="form-label">Ano de Fabricação:</label>
        <input type="number" class="form-control" id="ano_fabricacao" name="ano_fabricacao" min="1900" max="<?= date('Y') ?>" required>
    </div>
    <div class="mb-3">
        <label for="tipo_combustivel" class="form-label">Tipo de Combustível:</label>
        <select class="form-select" id="tipo_combustivel" name="tipo_combustivel" required>
            <option value="">Selecione...</option>
            <option value="Gasolina">Gasolina</option>
            <option value="Etanol">Etanol</option>
            <option value="Diesel">Diesel</option>
            <option value="Flex">Flex</option>
            <option value="Eletrico">Elétrico</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="capacidade" class="form-label">Capacidade (passageiros):</label>
        <input type="number" class="form-control" id="capacidade" name="capacidade" min="1" required>
    </div>
    
    <div class="mb-3">
        <label for="ano_incorporacao" class="form-label">Ano de Incorporação na Frota:</label>
        <input type="number" class="form-control" id="ano_incorporacao" name="ano_incorporacao" min="1900" max="<?= date('Y') ?>" required>
    </div>
    <div class="mb-3">
        <label for="ano_baixa" class="form-label">Ano de Baixa (Opcional):</label>
        <input type="number" class="form-control" id="ano_baixa" name="ano_baixa" min="1900" max="<?= date('Y') ?>">
    </div>
    <button type="submit" class="btn btn-primary" style="background-color: #343a40; border-color: #343a40;">Cadastrar Veículo</button>
    <a href="gerenciar_veiculos.php" class="btn btn-secondary">Voltar</a>
</form>

<?php
require_once("rodape.php");
?>