<?php
require_once("cabecalho.php"); // Inclui o cabeçalho com a verificação de sessão e conexão


if (isset($_GET['id'])) {
    $idveiculo = $_GET['id'];

    try {
        
        $stmt = $pdo->prepare("DELETE FROM veiculos WHERE idveiculos = ?");
        
        $stmt->execute([$idveiculo]);

        
        if ($stmt->rowCount() > 0) {
            $_SESSION['mensagem_sucesso'] = "Veículo excluído com sucesso!";
        } else {
            $_SESSION['mensagem_erro'] = "Veículo não encontrado ou não foi possível excluir.";
        }
    } catch (PDOException $e) {
        
        $_SESSION['mensagem_erro'] = "Erro ao excluir veículo: " . htmlspecialchars($e->getMessage());
    }
} else {
    $_SESSION['mensagem_erro'] = "ID do veículo não fornecido.";
}


header("Location: gerenciar_veiculos.php");
exit();
?>