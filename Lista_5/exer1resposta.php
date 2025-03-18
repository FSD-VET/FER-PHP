<?php
    declare(strict_types=1); //obriga que todas as funções e variaveis tenham algum tipo definido
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista 5 - Exercício 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1>Lista 5 - Exercício 1</h1>

    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    
        try { //verificando as informações do formulario - enviadas

            $contatos = array();//inicia um array para armazenar os contatos

            $nomes = $_POST['nome']; 
            $telefones = $_POST['tel'];


            for($i=0; $i<5; $i++){//loop de 5 contatos
                $nome = $nomes[$i]; 
                $telefone = $telefones[$i];
            //$posicao = $nome[$i];
            //$contato[$posicao[$i]] = $tel[$i];
                
                $nomeDuplicado = false;//verificar se o nome está duplicado/já existe  
                foreach ($contatos as $existeNome => $valor) {
                    if ($existeNome == $nome) {
                        $nomeDuplicado = true;
                        break;
                    }
                }
       
                $telefoneDuplicado = false;//verificar se o telefone está duplicado
                foreach ($contatos as $existeNome => $existeTelefone) {
                    if ($existeTelefone == $telefone) {
                        $telefoneDuplicado = true;
                        break;
                    }
                }

                if ($nomeDuplicado || $telefoneDuplicado) {//se o nome ou o telefone forem duplicados, emite erro 
                    echo "<p>O nome '$nome' ou telefone '$telefone' já existe.</p>";
                    continue; // Pula para o próximo contato
                }

                $contatos[$nome] = $telefone;//nome e telefone adicionados no contato
            }
            
            //echo '<pre>';
            //var_dump($contatos);// para testar se está guardando os dados
            //echo '</pre>';

            if (count($contatos) >0) {//se exixtir contato, segue para exibição
                
                ksort($contatos);//ordenando os contatos em ordem alfabética

                echo "<h3>Lista de Contatos</h3>";
                echo "<ul>";//lista ordenada
                foreach ($contatos as $nome => $telefone) {
                    echo "<li><strong>$nome</strong>: $telefone</li>";
                    }
                echo "</ul>";
            }

            else {
                 echo "Nenhum contato cadastrado";
            }
    
        } 

        catch(Exception $e) {  //ele armazema o erro - se existir  //$e é o pedacinho de memória que armazena o erro
            echo $e->getMessage(); //exibe o erro
        }

    }
                        
    ?>
      
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>