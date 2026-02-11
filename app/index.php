<?php
if (!file_exists("saldo.json")) {
    die("Arquivo de saldo não encontrado");
}

$saldo = json_decode(file_get_contents("saldo.json"), true);

if (!$saldo) {
    die("Erro ao carregar saldo");
}

echo "<h1>Saldo Atual</h1>";
foreach ($saldo as $conta => $valor) {
    echo "<p>$conta: R$ $valor</p>";
}
