<?php
require_once("cabecalho.php"); // Inclui o cabeçalho e a conexão com o banco de dados


$total_veiculos = 0;
$total_motoristas = 0;
$total_passageiros = 0;
$corridas_hoje = 0;

try {
    // Total de Veículos Cadastrados
    $stmt = $pdo->query("SELECT COUNT(idveiculos) AS total FROM veiculos");
    $total_veiculos = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

    // Total de Motoristas Ativos 
    $stmt = $pdo->query("SELECT COUNT(idmotorista) AS total FROM motorista");
    $total_motoristas = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

    // Total de Passageiros Registrados
    $stmt = $pdo->query("SELECT COUNT(idpassageiro) AS total FROM passageiro");
    $total_passageiros = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

    // Corridas Hoje
    $data_hoje = date('Y-m-d'); 
    $stmt = $pdo->prepare("SELECT COUNT(idcorrida) AS total FROM corrida WHERE data_corrida = ?");
    $stmt->execute([$data_hoje]);
    $corridas_hoje = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

} catch (PDOException $e) {
    // Em caso de erro no banco de dados, defina os totais como "Erro"
    $total_veiculos = "Erro";
    $total_motoristas = "Erro";
    $total_passageiros = "Erro";
    $corridas_hoje = "Erro";
    $_SESSION['mensagem_erro'] = "Erro ao carregar dados do dashboard: " . htmlspecialchars($e->getMessage());
}

?>

<div class="container mt-4">
    <h2 class="text-center mb-4">Bem-vindo ao Sistema de Controle Frota de Taxi!</h2>
    <p class="text-center mb-5">Aqui você pode gerenciar seus veículos, motoristas, passageiros e corridas de forma eficiente.</p>

    <div class="card p-4 shadow-sm">
        <p>Usuário logado: <strong><?= htmlspecialchars($_SESSION['usuario_nome'] ?? 'Convidado') ?></strong></p>

        <div class="row text-center mb-4">
            <div class="col-md-3 mb-3">
                <div class="p-3 bg-info text-white rounded">
                    <h3><?= htmlspecialchars($total_veiculos) ?></h3>
                    <p>Veículos Cadastrados</p>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="p-3 bg-success text-white rounded">
                    <h3><?= htmlspecialchars($total_motoristas) ?></h3>
                    <p>Motoristas Ativos</p>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="p-3 bg-warning text-dark rounded">
                    <h3><?= htmlspecialchars($total_passageiros) ?></h3>
                    <p>Passageiros Registrados</p>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="p-3 bg-danger text-white rounded">
                    <h3><?= htmlspecialchars($corridas_hoje) ?></h3>
                    <p>Corridas Hoje</p>
                </div>
            </div>
        </div>

        <div class="d-flex flex-wrap justify-content-center gap-2">
            <a href="gerenciar_veiculos.php" class="btn btn-secondary">Gerenciar Veículos</a>
            <a href="gerenciar_motoristas.php" class="btn btn-secondary">Gerenciar Motoristas</a>
            <a href="gerenciar_passageiro.php" class="btn btn-secondary">Gerenciar Passageiros</a>
            <a href="gerenciar_viagens.php" class="btn btn-secondary">Gerenciar Viagens</a>
            
            <a href="registrar_corrida.php" class="btn btn-secondary">Gerenciar Corridas</a>
            <a href="relatorio.php" class="btn btn-secondary">Gerar Relatórios</a>
        </div>
    </div>
</div>

<?php
require_once("rodape.php"); // Inclui o rodapé
?>