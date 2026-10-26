<?php
session_start();
require_once 'funcoes.php';
verificarLogin();
require_once "cabecalho.php";


echo "<h2>Listar Prescrição</h2>";


$idoso = listarIdoso($conexao);


echo "<h2>Atualizar Prescrição</h2>";

if (isset($_POST['atualizar'])) {

    $frequencia = $_POST['prescricao_frequencia'];
    $dosagem = $_POST['prescricao_dosagem'];
    $horario_primeira_dose = $_POST['prescricao_horario_primeira_dose'];
    $data_inicio = $_POST['prescricao_data_inicio'];
    $observacao = $_POST['prescricao_observacao'];
    $medicamento_id = $_POST['medicamento_medicamento_id'];
    $cuidado_id = $_POST['cuidado_cuidado_id'];
    $pessoa_id = $_POST['pessoa_id'];
    $cuidador = $_POST['cuidador'];

    if (atualizaprescricao($conexao, $medicamento_id, $cuidado_id, $pessoa_id, $cuidador, $frequencia, $dosagem, $horario_primeira_dose, $data_inicio, $observacao)) {

        header("Location: cuidado.php?sucesso=1");
        exit;

    } else {
        echo "Erro ao atualizar a prescrição.";
    }
}

echo "<h2>Deletar Prescrição</h2>";

if (isset($_POST['Deletar'])) {

    $id = $_POST['id'];

    $sucesso = deletarprescricao($conexao, $id);

    if ($sucesso) {
        echo "Idoso deletado com sucesso!";
    } else {
        echo "Erro ao deletar idoso. Verifique os dados.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <h3>Deletar Idoso</h3>

    <form method="POST" enctype="multipart/form-data">

        <label for="id">ID:</label><br>
        <input type="number" name="id" id="id" required>

        <button type="submit" name="Deletar">Deletar Idoso</button>

    </form>
<br> <br>


<?php 
echo "<button>";
echo "<a href='cuidado.php'>Voltar a pagina de listagem</a>";
echo "</button>";
?>
    
</body>
</html>
