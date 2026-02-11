<?php

while (true) {

    $cmd = "/opt/kafka/bin/kafka-console-consumer.sh \
        --bootstrap-server kafka:9092 \
        --topic pix_mensagem_transacao \
        --group pix_group \
        --max-messages 1 2>/dev/null";

    $msg = trim(shell_exec($cmd) ?? '');

    if ($msg !== '') {

        echo "Mensagem recebida: $msg\n";

        $data = json_decode($msg, true);

        $from  = $data["from"];
        $to    = $data["to"];
        $valor = (int)$data["valor"];

        $saldo = json_decode(file_get_contents("saldo.json"), true);

        $saldo[$from] -= $valor;
        $saldo[$to]   += $valor;

        file_put_contents("saldo.json", json_encode($saldo, JSON_PRETTY_PRINT));

        echo "Transferência processada\n";
    }

    sleep(1);
}
