
<?php
session_start();
require_once 'funcoes.php';
verificarLogin();
require_once "cabecalho.php";

// Marcar prescrição como SIM ou NÃO
if (isset($_POST['marcar'])) {

    $medicamento_id = $_POST['medicamento_id'];
    $cuidado_id = $_POST['cuidado_id'];
    $pessoa_id = $_POST['pessoa_id'];
    $cuidador = $_POST['cuidador'];
    $tomou = $_POST['tomou'];

    if (marcarprescricao($conexao, $medicamento_id, $cuidado_id, $pessoa_id, $cuidador, $tomou)) {
        echo "Prescrição marcada com sucesso!<br>";
    } else {
        echo "Erro ao marcar prescrição.<br>";
    }
}

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
    echo $p['prescricao_observacao'] . "<br>";

    echo "Tomou o medicamento? ";

    if ($p['prescricao_tomada'] == 1) {
        echo "SIM";
    } else {
        echo "NÃO";
    }
?>

    <form method="POST">

        <input type="hidden" name="medicamento_id"
            value="<?php echo $p['medicamento_medicamento_id']; ?>">

        <input type="hidden" name="cuidado_id"
            value="<?php echo $p['cuidado_cuidado_id']; ?>">

        <input type="hidden" name="pessoa_id"
            value="<?php echo $p['cuidado_fk_pessoa_pessoa_id']; ?>">

        <input type="hidden" name="cuidador"
            value="<?php echo $p['cuidado_fk_pessoa_cuidador']; ?>">

        <button type="submit" name="tomou" value="1">
            SIM
        </button>

        <button type="submit" name="tomou" value="0">
            NÃO
        </button>

        <input type="hidden" name="marcar" value="1">

    </form>

    <hr>

<?php
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
