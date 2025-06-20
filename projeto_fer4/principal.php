<?php
  require_once("cabecalho.php");

$total_veiculos = 0;
$total_motoristas = 0;
$total_passageiros = 0;
$total_corridas_hoje = 0;

require_once("conexao.php");

try {
    $stmt = $pdo->query("SELECT COUNT(*) FROM veiculos");
    $total_veiculos = $stmt->fetchColumn();

    $stmt = $pdo->query("SELECT COUNT(*) FROM motorista");
    $total_motoristas = $stmt->fetchColumn();

    $stmt = $pdo->query("SELECT COUNT(*) FROM passageiro");
    $total_passageiros = $stmt->fetchColumn();

    // Corridas realizadas hoje
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM corrida WHERE data_corrida = CURDATE()");
    $stmt->execute();
    $total_corridas_hoje = $stmt->fetchColumn();

} catch (PDOException $e) {
    error_log("Erro ao buscar dados do dashboard: " . $e->getMessage());
}

?>

<div class="jumbotron bg-light p-5 rounded-3">
    <h1 class="display-4"><STRONG>BEM VINDO AO TAXI FLEET</STRONG></h1>
    <h1 class="display-4">O seu sistema de Controle de Frota de Taxi!</h1>
    <p class="lead">Aqui você pode gerenciar seus veículos, motoristas, passageiros e corridas de forma eficiente.</p>
    <hr class="my-4">
    <p>Usuário logado: <strong><?= htmlspecialchars($_SESSION['usuario_nome'] ?? 'Convidado') ?></strong></p>

    <div class="row text-center mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title"><?= $total_veiculos ?></h5>
                    <p class="card-text">Veículos Cadastrados</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title"><?= $total_motoristas ?></h5>
                    <p class="card-text">Motoristas Ativos</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-dark">
                <div class="card-body">
                    <h5 class="card-title"><?= $total_passageiros ?></h5>
                    <p class="card-text">Passageiros Registrados</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5 class="card-title"><?= $total_corridas_hoje ?></h5>
                    <p class="card-text">Corridas Hoje</p>
                </div>
            </div>
        </div>
    </div>

    <p class="lead">
        <a class="btn btn-primary btn-lg me-2 mb-2" href="gerenciar_veiculos.php" role="button" style="background-color: #343a40; border-color: #343a40;">Gerenciar Veículos</a>
        <a class="btn btn-primary btn-lg me-2 mb-2" href="gerenciar_motoristas.php" role="button" style="background-color: #343a40; border-color: #343a40;">Gerenciar Motoristas</a>
        <a class="btn btn-primary btn-lg me-2 mb-2" href="gerenciar_passageiro.php" role="button" style="background-color: #343a40; border-color: #343a40;">Gerenciar Passageiros</a> 
        <a class="btn btn-primary btn-lg me-2 mb-2" href="registrar_corrida.php" role="button" style="background-color: #343a40; border-color: #343a40;">Gerenciar Corrida</a>
        <a class="btn btn-primary btn-lg mb-2" href="relatorio.php" role="button" style="background-color: #343a40; border-color: #343a40;">Relatórios</a>
    </p>
</div>

<div class="row mt-5">
    </div>

<?php
  require_once("rodape.php");
?>