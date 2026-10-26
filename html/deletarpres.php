
<?php
session_start();
require_once 'funcoes.php';
verificarLogin();
require_once "cabecalho.php";

echo "<h2>Deletar Prescrição</h2>";

if (isset($_POST['Deletar'])) {
    $medicamento_id = $_POST['medicamento_medicamento_id'];
    $cuidado_id = $_POST['cuidado_cuidado_id'];
    $pessoa_id = $_POST['pessoa_id'];
    $cuidador = $_POST['cuidador'];

    $sucesso = deletarprescricao($conexao, $medicamento_id, $cuidado_id, $pessoa_id, $cuidador);

    if ($sucesso) {
        echo "Prescrição deletada com sucesso!";
    } else {
        echo "Erro ao deletar prescrição. Verifique os dados.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar Prescrição</title>
</head>
<body>

    <h3>Deletar prescrição</h3>

    <form method="POST">

        <label for="medicamento_medicamento_id">ID do medicamento:</label><br>
        <input type="number" name="medicamento_medicamento_id" id="medicamento_medicamento_id" required>

        <br><br>

        <label for="cuidado_cuidado_id">ID do cuidado:</label><br>
        <input type="number" name="cuidado_cuidado_id" id="cuidado_cuidado_id" required>

        <br><br>

        <label for="pessoa_id">ID da pessoa:</label><br>
        <input type="number" name="pessoa_id" id="pessoa_id" required>

        <br><br>

        <label for="cuidador">ID do cuidador:</label><br>
        <input type="number" name="cuidador" id="cuidador" required>

        <br><br>

        <button type="submit" name="Deletar"
            onclick="return confirm('Tem certeza que deseja deletar esta prescrição?')">
            Deletar prescrição
        </button>

    </form>

    <br><br>

    <button>
        <a href="prescricao.php">Voltar à página de listagem</a>
    </button>

</body>
</html>
