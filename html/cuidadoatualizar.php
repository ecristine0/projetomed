<?php
session_start();
require_once 'funcoes.php';
verificarLogin();
require_once "cabecalho.php";

echo "<h2>Atualizar Idoso</h2>";

if (isset($_POST['atualizar'])) {

    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $data_nas = $_POST['data_nas'];

    // Pega a foto enviada
    $foto = $_FILES['foto']['name'];

    // Caminho para salvar a foto
    $caminho = "img/" . $foto;

    // Move a foto para a pasta img
    move_uploaded_file($_FILES['foto']['tmp_name'], $caminho);

    if (atualizaridoso($conexao, $id, $nome, $data_nas, $caminho)) {

        header("Location: cuidado.php?sucesso=1");
        exit;

    } else {
        echo "Erro ao atualizar o idoso.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuidado</title>
</head>
<body>
    <form method="POST" action="cuidado.php" enctype="multipart/form-data">    

    <label>Nome:</label><br>
    <input type="text" name="nome" required>

    <br><br>

    <label>Data de nascimento:</label><br>
    <input type="date" name="data_nas" required>

    <br><br>

    <label>Foto:</label><br>
    <input type="file" name="foto" accept="image/*" required>

    <br><br>

    <button type="submit" name="atualizar">
        Atualizar Idoso
    </button>

</form>
</body>
</html>