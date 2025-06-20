<?php
    require_once("cabecalho.php");

    function retornaCategorias() {
        require("conexao.php");
        try{
            $sql = "SELECT * FROM categoria";
            $stmt = $pdo->query($sql);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            die("Erro ao consultar caegorias: " .$e->getMessage());
        }
    }

    function retornaProduto($id) {
        require("conexao.php");
        try{
            $sql = "SELECT * FROM produto WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);
            $produto = $stmt->fetch();
            if (!$produto)
                die("Erro ao reornar o produto!");
            else
            return $produto;
        } catch (Exception $e) {
            die("Erro ao consultar o produto: " .$e->getMessage());
        }
    }

    function alterarProduto($nome, $descricao, $preco, $categoria, $id) {
        require("conexao.php");
        try{
            $sql = "UPDATE produto SET nome = ?, descricao = ?, preco = ?,
                    categoria_id = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            
            $produto = $stmt->fetch();
            if ($stmt->execute([$nome, $descricao, $preco, $categoria, $id]))
                header('location: produtos.php?edicao=true');
            else
            header('location: produtos.php?edicao=false');
        } catch (Exception $e) {
            die("Erro ao alterar produto: " .$e->getMessage());
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $categoria = $_POST['categoria'];
        alterarProduto($nome, $descricao, $preco, $categoria, $id);
    } else {
        $categorias = retornaCategorias();
        $produto = retornaProduto($_GET['id']);
    }
    
    
?>

    <h2>Editar Produto</h2>

<form method="post">
    <input type="hidden" name="id" value="<?= $produto['id'] ?>">
                        
    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input value="<?=$produto['nome'] ?>" type="text" id="nome" name="nome" class="form-control" required="">
    </div>

    <div class="mb-3">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea id="descricao" name="descricao" class="form-control" rows="4" required=""> <?=$produto['descricao'] ?></textarea>
    </div>

    <div class="mb-3">
        <label for="preco" class="form-label">preco</label>
        <input value="<?=$produto['preco'] ?>" type="number" id="preco" name="preco" class="form-control" required="">
    </div>

     <div class="mb-3">
        <label for="categoria" class="form-label">Categoria</label>
        <select id="categoria" name="categoria" class="form-select" required="">
            <?php
            foreach($categorias as $c):
            ?>
                <option value="<?= $c['id'] ?>" <?php if ($c['id'] == $produto['categoria_id']) echo 'selected' ?>><?= $c['nome']?></option>

            <?php
            endforeach;
            ?>
                   
        </select>

<button type="submit" class="btn btn-primary">Enviar</button>
<button type="button" class="btn btn-secodary" onclick="history.back();">Voltar</button>
</form>
            

<?php
    require_once("rodape.php");
?>