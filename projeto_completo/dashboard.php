<?php
  
    require_once("cabecalho.php");

    function retornaProdutos(){
    require("conexao.php");
    try{
        $sql = "SELECT p.*, c.nome as nome_categoria
                FROM produto p 
                INNER JOIN categoria c ON c.id = p.categoria_id";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    } catch (Exception $e){
        die("Erro ao consultar produto: ".$e->getMessage());
        }
    }

    $produtos = retornaProdutos();

?>

    <h1> Dashboard <h1>

    <a href="relatorio.php" target="_blank"> Relatório de Produtos</a>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <div id="chart_div"></div>
    <script>
        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawBasic);

    function drawBasic() {

        var data = google.visualization.arrayToDataTable([
            ['Produto', 'Preço'],

            <?php

                foreach($produtos as $p) {
                    $nome = $p['nome'];
                    $preco = $p['preco'];
                    echo "['$nome', $preco],";
                }

            ?>
            
        ]);

        var options = {
            title: 'Preço dos produtos',
            chartArea: {width: '50%'},
            hAxis: {//horizontal
            title: 'Preço',
            minValue: 0
            },
            vAxis: {//vertical
            title: 'Nome do Produto'
            }
        };

        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
    </script>


<?php

    require_once('rodape.php');




