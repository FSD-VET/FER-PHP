<?php
require_once("cabecalho.php"); // Inclui o cabeçalho com a verificação de sessão e conexão

unset($_SESSION['mensagem_sucesso']);
unset($_SESSION['mensagem_erro']);


if (isset($_GET['id'])) {
    $idcorrida = $_GET['id'];

    try {
        
        $stmt = $pdo->prepare("DELETE FROM corrida WHERE idcorrida = ?");
        
        $stmt->execute([$idcorrida]);

        
        if ($stmt->rowCount() > 0) {
            $_SESSION['mensagem_sucesso'] = "Corrida excluída com sucesso!";
        } else {
            $_SESSION['mensagem_erro'] = "Corrida não encontrada ou não foi possível excluir.";
        }
    } catch (PDOException $e) {
        $_SESSION['mensagem_erro'] = "Erro ao excluir corrida: " . htmlspecialchars($e->getMessage());
    }
} else {
    $_SESSION['mensagem_erro'] = "ID da corrida não fornecido.";
}


header("Location: registrar_corrida.php");
exit();
?>