<?php
require_once("cabecalho.php"); // Inclui o cabeçalho com a verificação de sessão e conexão


if (isset($_GET['id'])) {
    $idmotorista = $_GET['id'];

    try {
        
        $stmt = $pdo->prepare("DELETE FROM motorista WHERE idmotorista = ?");
        
        $stmt->execute([$idmotorista]);

        
        if ($stmt->rowCount() > 0) {
            $_SESSION['mensagem_sucesso'] = "Motorista excluído com sucesso!";
        } else {
            $_SESSION['mensagem_erro'] = "Motorista não encontrado ou não foi possível excluir.";
        }
    } catch (PDOException $e) {
        
        $_SESSION['mensagem_erro'] = "Erro ao excluir motorista: " . htmlspecialchars($e->getMessage());
    }
} else {
    $_SESSION['mensagem_erro'] = "ID do motorista não fornecido.";
}


header("Location: gerenciar_motoristas.php");
exit();
?>