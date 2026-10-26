
<?php
echo "<h2>Adicionar Prescrição</h2>";

if (isset($_POST['adicionar'])) {

    $medicamento_id = $_POST['medicamento_medicamento_id'];
    $cuidado_id = $_POST['cuidado_cuidado_id'];
    $pessoa_id = $_POST['pessoa_id'];
    $cuidador = $_POST['cuidador'];
    $frequencia = $_POST['prescricao_frequencia'];
    $dosagem = $_POST['prescricao_dosagem'];
    $horario_primeira_dose = $_POST['prescricao_horario_primeira_dose'];
    $data_inicio = $_POST['prescricao_data_inicio'];
    $observacao = $_POST['prescricao_observacao'];

    if (adicionarprescricao($conexao, $medicamento_id, $cuidado_id, $pessoa_id, $cuidador, $frequencia, $dosagem, $horario_primeira_dose,$data_inicio, $observacao )) {
        header("Location: cuidado.php?sucesso=1");
        exit;

    } else {
        echo "Erro ao adicionar a prescrição.";
    }
}
?>

<form method="POST">

    <label>Medicamento:</label>
    <input type="number" name="medicamento_medicamento_id" required> <br><br>

    <label>Cuidado:</label>
    <input type="number" name="cuidado_cuidado_id" required> <br><br>

    <label>ID da Pessoa:</label>
    <input type="number" name="pessoa_id" required> <br><br>

    <label>Cuidador:</label>
    <input type="number" name="cuidador" required> <br><br>

    <label>Frequência:</label>
    <input type="text" name="prescricao_frequencia" required> <br><br>

    <label>Dosagem:</label>
    <input type="number" step="any" name="prescricao_dosagem" required> <br><br>

    <label>Horário da primeira dose:</label>
    <input type="time" name="prescricao_horario_primeira_dose" required> <br><br>

    <label>Data de início:</label>
    <input type="date" name="prescricao_data_inicio" required> <br><br>

    <label>Observação:</label>
    <textarea name="prescricao_observacao"></textarea> <br><br>

    <button type="submit" name="adicionar">Adicionar Prescrição</button>

</form>
