<?php
include_once 'cabecalho.php';
$sql = "SELECT idpassageiro, nome, telefone, endereco FROM passageiro";

try {
    $stmt = $pdo->query($sql);
    $passageiros = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>Erro ao buscar passageiro: " . htmlspecialchars($e->getMessage()) . "</div>";
    $passageiros = [];
}
?>


    <h2>Gerenciar Passageiros</h2>

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

<p>Nesta página, você poderá visualizar, adicionar, editar e excluir passageiros.</p>

<a href="adicionar_passageiro.php" class="btn btn-success mb-3" style="background-color: #343a40; border-color: #343a40;">Adicionar Novo Passageiro</a>
    <div class="table-responsive">
    <table class="table table-striped table-bordered" id="tabela_passageiro">
        <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>Endereço</th>
                    <th>Ações</th> </tr>
                </tr>
            </thead>
            <tbody>
                <?php
            
            if (count($passageiros) > 0) {
                foreach ($passageiros as $row) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['idpassageiro']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['telefone']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['endereco']) . "</td>";
                    echo "<td>";
                    echo "<a href='editar_passageiro.php?id=" . htmlspecialchars($row['idpassageiro']) . "' class='btn btn-sm btn-info me-1'>Editar</a>";
                    echo "<a href='excluir_passageiro.php?id=" . htmlspecialchars($row['idpassageiro']) . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Tem certeza que deseja excluir este passageiro?\")'>Excluir</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Nenhum passageiro cadastrado.</td></tr>";
            }
            ?>
            </tbody>
        </table>
    
</div>

<?php
include_once 'rodape.php';
?>