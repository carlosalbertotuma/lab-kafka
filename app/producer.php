<?php
$from = $_GET['from'] ?? '';
$to   = $_GET['to'] ?? '';
$valor = (int)($_GET['valor'] ?? 0);

$msg = json_encode([
    "from" => $from,
    "to" => $to,
    "valor" => $valor
]);

// Escapa corretamente o shell para que a mensagem vá para o producer
$cmd = "echo " . escapeshellarg($msg) . " | /opt/kafka/bin/kafka-console-producer.sh --bootstrap-server kafka:9092 --topic pix_mensagem_transacao";

exec($cmd);

echo "Transferência enviada!";
