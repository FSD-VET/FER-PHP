<?php
require_once("cabecalho.php"); // Inclui o cabeçalho com a verificação de sessão e conexão
$sql = "SELECT idmotorista, nome, numero_cnh, telefone, multas FROM motorista";

try {
    
    $stmt = $pdo->query($sql);
    
    $motoristas = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    
    echo "<div class='alert alert-danger'>Erro ao buscar motoristas: " . htmlspecialchars($e->getMessage()) . "</div>";
    $motoristas = []; 
}

?>


<h2>Gerenciar Motoristas</h2>

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

<p>Nesta página, você poderá visualizar, adicionar, editar e excluir motoristas.</p>

<a href="adicionar_motorista.php" class="btn btn-success mb-3" style="background-color: #343a40; border-color: #343a40;">Adicionar Novo Motorista</a>

<div class="table-responsive">
    <table class="table table-striped table-bordered" id="tabela_motoristas">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CNH</th>
                <th>Telefone</th>
                <th>Multas</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($motoristas) > 0) {
                foreach($motoristas as $row) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["idmotorista"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["nome"]) . "</td>";                    
                    echo "<td>" . htmlspecialchars($row["numero_cnh"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["telefone"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["multas"]) . "</td>";
                    echo "<td>";
                    echo "<a href='editar_motorista.php?id=" . htmlspecialchars($row["idmotorista"]) . "' class='btn btn-sm btn-info me-1'>Editar</a>";
                    echo "<a href='excluir_motorista.php?id=" . htmlspecialchars($row["idmotorista"]) . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Tem certeza que deseja excluir este motorista?\")'>Excluir</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>Nenhum motorista cadastrado.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
require_once("rodape.php"); // Inclui o rodapé
?>