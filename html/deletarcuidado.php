<?php
session_start();
require_once 'funcoes.php';
verificarLogin();

if (isset($_POST['Deletar'])) {

    $id = $_POST['id'];

    $sucesso = deletaridoso($conexao, $id);

    if ($sucesso) {
        echo "Idoso deletado com sucesso!";
    } else {
        echo "Erro ao deletar idoso. Verifique os dados.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar Idoso</title>
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
