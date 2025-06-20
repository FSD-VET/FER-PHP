<?php
require_once("cabecalho.php"); // Inclui o cabeçalho e a conexão

// Dados para Relatórios 
$total_corridas = 0;
$valor_total_arrecadado = 0;
$corridas_por_motorista = [];
$valor_por_motorista = [];
$viagens_mais_frequentes = [];

try {
    // Total de Corridas
    $stmt = $pdo->query("SELECT COUNT(idcorrida) AS total_corridas FROM corrida");
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_corridas = $resultado['total_corridas'];

    // Total Arrecadado
    $stmt = $pdo->query("SELECT SUM(valor_corrida) AS valor_total FROM corrida");
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    $valor_total_arrecadado = $resultado['valor_total'] ?? 0; // Garante 0 se não houver corridas

    // Número de Corridas por Motorista (relatório e gráfico)
    $stmt = $pdo->query("
        SELECT m.nome, COUNT(c.idcorrida) AS num_corridas
        FROM corrida c
        JOIN motorista m ON c.motorista_idmotorista = m.idmotorista
        GROUP BY m.nome
        ORDER BY num_corridas DESC
    ");
    $corridas_por_motorista = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Valor Arrecadado por Motorista
    $stmt = $pdo->query("
        SELECT m.nome, SUM(c.valor_corrida) AS valor_arrecadado
        FROM corrida c
        JOIN motorista m ON c.motorista_idmotorista = m.idmotorista
        GROUP BY m.nome
        ORDER BY valor_arrecadado DESC
    ");
    $valor_por_motorista = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Viagens Mais Frequentes (Origem -> Destino)
    $stmt = $pdo->query("
        SELECT v.origem, v.destino, COUNT(c.idcorrida) AS num_ocorrencias
        FROM corrida c
        JOIN viagem v ON c.viagem_idviagem = v.idviagem
        GROUP BY v.origem, v.destino
        ORDER BY num_ocorrencias DESC
        LIMIT 5
    ");
    $viagens_mais_frequentes = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>Erro ao gerar relatórios: " . htmlspecialchars($e->getMessage()) . "</div>";
    $total_corridas = 'Erro';
    $valor_total_arrecadado = 'Erro';
    $corridas_por_motorista = [];
    $valor_por_motorista = [];
    $viagens_mais_frequentes = [];
}

?>

<div class="container mt-4">
    <h2>Relatórios e Gráficos</h2>

    <p>Aqui você pode visualizar diversos relatórios sobre as operações da sua frota.</p>

    <div class="card mb-4">
        <div class="card-header" style="background-color: #343a40; color: white;">
            Relatórios Resumidos
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="alert alert-info">
                        <strong>Total de Corridas Registradas:</strong> <?= htmlspecialchars($total_corridas) ?>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="alert alert-success">
                        <strong>Valor Total Arrecadado em Corridas:</strong> R$ <?= number_format($valor_total_arrecadado, 2, ',', '.') ?>
                    </div>
                </div>
            </div>

            <h4>Corridas por Motorista</h4>
            <?php if (count($corridas_por_motorista) > 0): ?>
            <ul class="list-group mb-3">
                <?php foreach ($corridas_por_motorista as $item): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?= htmlspecialchars($item['nome']) ?>
                        <span class="badge bg-primary rounded-pill"><?= htmlspecialchars($item['num_corridas']) ?> corridas</span>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php else: ?>
                <p>Nenhum dado de corrida por motorista disponível.</p>
            <?php endif; ?>

            <h4>Valor Arrecadado por Motorista</h4>
            <?php if (count($valor_por_motorista) > 0): ?>
            <ul class="list-group mb-3">
                <?php foreach ($valor_por_motorista as $item): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?= htmlspecialchars($item['nome']) ?>
                        <span class="badge bg-success rounded-pill">R$ <?= number_format($item['valor_arrecadado'], 2, ',', '.') ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php else: ?>
                <p>Nenhum dado de valor arrecadado por motorista disponível.</p>
            <?php endif; ?>

            <h4>Top 5 Viagens Mais Frequentes</h4>
            <?php if (count($viagens_mais_frequentes) > 0): ?>
            <ul class="list-group mb-3">
                <?php foreach ($viagens_mais_frequentes as $item): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?= htmlspecialchars($item['origem']) ?> &rarr; <?= htmlspecialchars($item['destino']) ?>
                        <span class="badge bg-secondary rounded-pill"><?= htmlspecialchars($item['num_ocorrencias']) ?> vezes</span>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php else: ?>
                <p>Nenhuma viagem frequente registrada.</p>
            <?php endif; ?>

        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header" style="background-color: #343a40; color: white;">
            Gráficos
        </div>
        <div class="card-body">
            <h4>Número de Corridas por Motorista</h4>
            <canvas id="corridasMotoristaChart"></canvas>
        </div>
    </div>

</div>

<a href="principal.php" class="btn btn-secondary">Voltar</a>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const corridasPorMotoristaData = <?= json_encode($corridas_por_motorista); ?>;

    if (corridasPorMotoristaData && corridasPorMotoristaData.length > 0) {
        const labels = corridasPorMotoristaData.map(item => item.nome);
        const data = corridasPorMotoristaData.map(item => item.num_corridas);

        const ctx = document.getElementById('corridasMotoristaChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar', // gráfico: barras
            data: {
                labels: labels,
                datasets: [{
                    label: 'Número de Corridas',
                    data: data,
                    backgroundColor: 'rgba(52, 58, 64, 0.7)', // Cor das barras
                    borderColor: 'rgba(52, 58, 64, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Número de Corridas'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Motorista'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false 
                    },
                    title: {
                        display: true,
                        text: 'Corridas Realizadas por Motorista'
                    }
                }
            }
        });
    } else {
        // Exibe mensagem se não houver dados para o gráfico
        const chartContainer = document.getElementById('corridasMotoristaChart').parentNode;
        chartContainer.innerHTML = '<p class="text-center text-muted">Não há dados suficientes para gerar o gráfico de corridas por motorista.</p>';
    }
});


</script>

<?php
require_once("rodape.php"); // Inclui o rodapé
?>