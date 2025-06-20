<?php
require_once("cabecalho.php"); // Inclui o cabeçalho com a verificação de sessão e conexão

$sql = "SELECT idviagem, origem, destino, distancia, data_viagem FROM viagem";

try {
    $stmt = $pdo->query($sql);
    $viagens = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>Erro ao buscar viagens: " . htmlspecialchars($e->getMessage()) . "</div>";
    $viagens = []; 
}

?>

<div class="container mt-4">
    <h2>Gerenciar Viagens</h2>

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

    <p>Nesta página, você poderá visualizar, adicionar, editar e excluir viagens.</p>

    <a href="adicionar_viagem.php" class="btn btn-success mb-3" style="background-color: #343a40; border-color: #343a40;">Adicionar Nova Viagem</a>

    <div class="table-responsive">
        <table class="table table-striped table-bordered" id="tabela_viagens">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Origem</th>
                    <th>Destino</th>
                    <th>Distância (km)</th>
                    <th>Data Viagem</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($viagens) > 0) {
                    foreach($viagens as $row) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["idviagem"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["origem"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["destino"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["distancia"]) . "</td>";
                        echo "<td>" . date('d/m/Y', strtotime($row["data_viagem"])) . "</td>";
                        echo "<td>";
                        echo "<a href='editar_viagem.php?id=" . htmlspecialchars($row["idviagem"]) . "' class='btn btn-sm btn-info me-1'>Editar</a>";
                        echo "<a href='excluir_viagem.php?id=" . htmlspecialchars($row["idviagem"]) . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Tem certeza que deseja excluir esta viagem?\")'>Excluir</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Nenhuma viagem cadastrada.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
require_once("rodape.php"); // Inclui o rodapé
?>