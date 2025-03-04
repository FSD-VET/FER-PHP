<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resposta do Exercício 5</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1>Resposta do Exercício 5</h1>

    <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            try { //verificando as informações do formulario - enviadas
                $mes = $_POST["mes"];
            

            switch ($mes) { //verifica o valor do mês informado
                case 1:
                    echo "O mês 1 é Janeiro";
                    break;
                case 2:
                    echo "O mês 2 é Fevereiro";
                    break;
                case 3:
                    echo "O mês 3 é Março";
                    break;
                case 4:
                    echo "O mês 4 é Abril";
                    break;
                case 5:
                    echo "O mês 5 é Maio";
                    break;
                case 6:
                    echo "O mês 6 é Junho";
                    break;
                case 7:
                    echo "O mês 7 é Julho";
                    break;
                case 8:
                    echo "O mês 8 é Agosto";
                    break;
                case 9:
                    echo "O mês 9 é Setembro";
                    break;
                case 10:
                    echo "O mês 10 é Outubro";
                    break;
                case 11:
                    echo "O mês 11 é Novembro";
                    break;
                case 12:
                    echo "O mês 12 é Dezembro";
                    break;
                //default: - se eu não tivesse colocado min="1" max="12" (no formulário) teria que acrescentar isso e também uma verificação
                    //echo "Número do mês inválido.";             if ($mes >= 1 && $mes <= 12) {
                                                        // depois do switch, inserir:
                                                            //else {
                                                            // echo "Número do mês inválido. Digite um número entre 1 e 12."; }
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