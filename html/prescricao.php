<?php
session_start();
require_once 'funcoes.php';
verificarLogin();
require_once "cabecalho.php";

echo "<h2>Listar Prescrição</h2>";

$prescricoes = listarPrescricoes($conexao);

if ($prescricoes === false) {
    die("Erro na consulta: " . $conexao->error);
}

while ($p = $prescricoes->fetch_assoc()) {
    echo $p['medicamento_nome'] . "<br>";
    echo $p['cuidado_nome'] . "<br>";
    echo $p['nome_cuidador'] . "<br>";
    echo $p['nome_paciente'] . "<br>";
    echo $p['prescricao_dosagem'] . "<br>";
    echo $p['prescricao_frequencia'] . "<br>";
    echo $p['prescricao_observacao'] . "<hr>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de prescrições</title>
</head>
<body>

    <a href="atualizarprescri.php">Atualizar</a>
    <a href="cadastropres.php">Cadastrar</a>
    <a href="deletarpres.php">Deletar</a>

</body>
</html>
