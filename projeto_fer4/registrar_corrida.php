<?php
require_once("cabecalho.php"); // Inclui o cabeçalho com a verificação de sessão e conexão

$sql = "SELECT
            c.idcorrida,
            c.valor_corrida,
            c.data_corrida,
            v.origem,
            v.destino,
            m.nome AS nome_motorista,
            ve.modelo AS modelo_veiculo,
            ve.placa AS placa_veiculo,
            p.nome AS nome_passageiro
        FROM corrida c
        JOIN viagem v ON c.viagem_idviagem = v.idviagem
        JOIN motorista m ON c.motorista_idmotorista = m.idmotorista
        JOIN veiculos ve ON c.veiculos_idveiculos = ve.idveiculos
        JOIN passageiro p ON c.passageiro_idpassageiro = p.idpassageiro";

try {
    $stmt = $pdo->query($sql);
    $corridas = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>Erro ao buscar corridas: " . htmlspecialchars($e->getMessage()) . "</div>";
    $corridas = []; 
}

?>

<div class="container mt-4">
    <h2>Registrar Corridas</h2>

    <?php
    
    if (isset($_SESSION['mensagem_sucesso'])) {
        echo "<div class='alert alert-success'>" . $_SESSION['mensagem_sucesso'] . "</div>";
        unset($_SESSION['mensagem_sucesso']); 
    }
    if (isset($_SESSION['mensagem_erro'])) {
        echo "<div class='alert alert-danger'>" . $_SESSION['mensagem_erro'] . "</div>";
        unset($_SESSION['mensagem_erro']); 
    }
    ?>

    <p>Nesta página, você poderá visualizar, adicionar, editar e excluir corridas.</p>

    <a href="adicionar_corrida.php" class="btn btn-success mb-3" style="background-color: #343a40; border-color: #343a40;">Adicionar Nova Corrida</a>

    <div class="table-responsive">
        <table class="table table-striped table-bordered" id="tabela_corridas">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Motorista</th>
                    <th>Veículo (Modelo - Placa)</th>
                    <th>Passageiro</th>
                    <th>Origem</th>
                    <th>Destino</th>
                    <th>Valor</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($corridas) > 0) {
                    foreach($corridas as $row) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["idcorrida"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["nome_motorista"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["modelo_veiculo"]) . " - " . htmlspecialchars($row["placa_veiculo"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["nome_passageiro"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["origem"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["destino"]) . "</td>";
                        echo "<td>R$ " . number_format($row["valor_corrida"], 2, ',', '.') . "</td>";
                        echo "<td>" . date('d/m/Y', strtotime($row["data_corrida"])) . "</td>";
                        echo "<td>";
                        echo "<a href='editar_corrida.php?id=" . htmlspecialchars($row["idcorrida"]) . "' class='btn btn-sm btn-info me-1'>Editar</a>";
                        echo "<a href='excluir_corrida.php?id=" . htmlspecialchars($row["idcorrida"]) . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Tem certeza que deseja excluir esta corrida?\")'>Excluir</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='13'>Nenhuma corrida cadastrada.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
require_once("rodape.php"); // Inclui o rodapé
?>