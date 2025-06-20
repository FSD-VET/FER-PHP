<?php
require_once("cabecalho.php"); 

$sql = "SELECT idveiculos, placa, modelo, marca, ano_fabricacao, tipo_combustivel, capacidade FROM veiculos";

try {
    $stmt = $pdo->query($sql);
    $veiculos = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>Erro ao buscar veículos: " . htmlspecialchars($e->getMessage()) . "</div>";
    $veiculos = [];
}
?>

<h2>Gerenciar Veículos</h2>

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

<p>Nesta página, você poderá visualizar, adicionar, editar e excluir veículos da frota.</p>

<a href="adicionar_veiculo.php" class="btn btn-success mb-3">Adicionar Novo Veículo</a>

<div class="table-responsive">
    <table class="table table-striped table-bordered" id="tabela_veiculos">
        <thead>
            <tr>
                <th>ID</th>
                <th>Placa</th>
                <th>Modelo</th>
                <th>Marca</th>
                <th>Ano Fab.</th>
                <th>Combustível</th>
                <th>Capacidade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($veiculos) > 0) {
                foreach($veiculos as $row) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["idveiculos"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["placa"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["modelo"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["marca"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["ano_fabricacao"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["tipo_combustivel"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["capacidade"]) . "</td>";
                    echo "<td>";
                    echo "<a href='editar_veiculo.php?id=" . htmlspecialchars($row["idveiculos"]) . "' class='btn btn-sm btn-info me-1'>Editar</a>";
                    echo "<a href='excluir_veiculo.php?id=" . htmlspecialchars($row["idveiculos"]) . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Tem certeza que deseja excluir este veículo?\")'>Excluir</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>
</div>

<?php
if (count($veiculos) == 0) {
    echo "<p class='text-muted mt-3'>Nenhum veículo cadastrado.</p>";
}
?>

<?php
require_once("rodape.php");
?>