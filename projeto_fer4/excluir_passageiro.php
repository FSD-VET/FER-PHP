<?php
require_once("cabecalho.php"); // Inclui o cabeçalho com a verificação de sessão e conexão


if (isset($_GET['id'])) {
    $idpassageiro = $_GET['id'];

    try {
        
        $stmt = $pdo->prepare("DELETE FROM passageiro WHERE idpassageiro = ?");
        
        $stmt->execute([$idpassageiro]);

        
        if ($stmt->rowCount() > 0) {
            $_SESSION['mensagem_sucesso'] = "Passageiro excluído com sucesso!";
        } else {
            $_SESSION['mensagem_erro'] = "Passageiro não encontrado ou não foi possível excluir.";
        }
    } catch (PDOException $e) {
        
        $_SESSION['mensagem_erro'] = "Erro ao excluir passageiro: " . htmlspecialchars($e->getMessage());
    }
} else {
    $_SESSION['mensagem_erro'] = "ID do passageiro não fornecido.";
}


header("Location: gerenciar_passageiro.php");
exit();
?>