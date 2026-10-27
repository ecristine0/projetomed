<?php
session_start();
require_once 'funcoes.php';
verificarLogin();
require_once "cabecalho.php";

echo "<h2>Listar Prescrição</h2>";

$prescricoes = listarPrescricoes($conexao);

foreach ($prescricoes as $prescricao) {
    echo "Medicamento: " .
        htmlspecialchars($prescricao['medicamento_nome']) . "<br>";

    echo "Cuidado: " .
        htmlspecialchars($prescricao['cuidado_nome']) . "<br>";

    echo "Cuidador: " .
        htmlspecialchars($prescricao['nome_cuidador']) . "<br>";

    echo "Paciente: " .
        htmlspecialchars($prescricao['nome_paciente']) . "<br>";

    echo "Dosagem: " .
        htmlspecialchars($prescricao['prescricao_dosagem']) . "<br>";

    echo "Frequência: " .
        htmlspecialchars($prescricao['prescricao_frequencia']) . "<br>";

    echo "Observação: " .
        htmlspecialchars($prescricao['prescricao_observacao']) . "<br>";

    echo "<hr>";
}
?>

 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de prescriçoes</title>
</head>
<body>
<a href="atualizarprescri.php">Atualizar</a>
<a href="deletarpres.php">Deletar</a>
    
</body>
</html>
