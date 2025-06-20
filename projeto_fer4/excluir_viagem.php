<?php
require_once("cabecalho.php"); // Inclui o cabeçalho com a verificação de sessão e conexão


if (isset($_GET['id'])) {
    $idviagem = $_GET['id'];

    try {
        
        $stmt = $pdo->prepare("DELETE FROM viagem WHERE idviagem = ?");
        
        $stmt->execute([$idviagem]);

        
        if ($stmt->rowCount() > 0) {
            $_SESSION['mensagem_sucesso'] = "Viagem excluída com sucesso!";
        } else {
            $_SESSION['mensagem_erro'] = "Viagem não encontrada ou não foi possível excluir.";
        }
    } catch (PDOException $e) {
        
        $_SESSION['mensagem_erro'] = "Erro ao excluir viagem: " . htmlspecialchars($e->getMessage());
    }
} else {
    $_SESSION['mensagem_erro'] = "ID da viagem não fornecido.";
}


header("Location: gerenciar_viagens.php");
exit();
?>