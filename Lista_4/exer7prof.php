<?php

declare(strict_types=1);

function diferncaEntreDatas(DateTime $data1, DateTime $data2,): void {
    $diferenca = $data1->diff($data2);
    echo "Diferença de dias entre as datas: ".$diferenca->d;
}
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $data1 = new DataTime($_POST['data1']);
        $data2 = new DataTime($_POST['data2']);

        diferncaEntreDatas($data1, $data2);

    }

    catch (Exception $e) {
        echo $e->getMessage();
    }
}