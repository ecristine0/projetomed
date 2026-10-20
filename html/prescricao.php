<?php
session_start();
require_once "funcoes.php";
verificarLogin();

if (isset($_POST["deletar"])) {
    deletarprescricao(
        $conexao,
        $_POST["medicamento_id"],
        $_POST["cuidado_id"],
        $_POST["pessoa_id"],
        $_POST["cuidador"]
    );

    header("Location: prescricao.php");
    exit;
}

$prescricoes = listarprescricao($conexao);
require_once "cabecalho.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>prescrição</title>
</head>
<body>
    <h1>Prescrição</h1>

    <form method="POST" action="prescricao.php">

    <input type="hidden" name="medicamento_id" value="<?php echo $p['medicamento_medicamento_id']; ?>">

    <input type="hidden" name="cuidado_id" value="<?php echo $p['cuidado_cuidado_id']; ?>">

    <input type="hidden" name="pessoa_id" value="<?php echo $p['cuidado_fk_pessoa_paciente']; ?>">
    
    <input type="hidden" name="cuidador" value="<?php echo $p['cuidado_fk_pessoa_cuidador']; ?>">

    <button type="submit" name="deletar" onclick="return confirm('Deseja deletar?')">
        Deletar
    </button>
</form>
</body>
</html>