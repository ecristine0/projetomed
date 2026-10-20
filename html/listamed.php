<?php
session_start();
require_once 'funcoes.php';
verificarLogin();
require_once "cabecalho.php";

echo "<h2>Listar Medicamentos</h2>";

$med = listarmedicamento($conexao);
while($medicamento = $med->fetch_assoc()){
    if (!empty($medicamento['foto'])) {
        echo "<img src='" . $medicamento['foto'] . "' width='100' alt='Capa'><br>";
    } else {
        echo "<em>[Sem imagem]</em><br>";
    }

    print_r($medicamento);
    echo "<hr>";
}

require_once "rodape.php";

?>