<?php
session_start();
require_once 'funcoes.php';
verificarLogin();
require_once "cabecalho.php";

echo "<h2>Listar Prescrição</h2>";

$prescricao = listarprescricao($conexao, $pessoa_id, $cuidador);

echo "<ul>";
echo "<li>";
echo "Medicamento: {$prescricao['medicamento_medicamento_id']}<br>";  
echo "Frequência: {$prescricao['prescricao_frequencia']}<br>";
echo "Dosagem: {$prescricao['prescricao_dosagem']}<br>";
echo "Horário: {$prescricao['prescricao_horario_primeira_dose']}<br>";
echo "Data de início: {$prescricao['prescricao_data_inicio']}<br>";
echo "Observação: {$prescricao['prescricao_observacao']}";
echo "</li>";

echo "</ul>";


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
