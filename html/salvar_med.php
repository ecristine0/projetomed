<?php
session_start();
require_once 'funcoes.php';
verificarLogin();
require_once "cabecalho.php";

$nome = $_POST['medicamento_nome'];
$laboratorio = $_POST['medicamento_laboratorio'];
$categoria = $_POST['medicamento_categoria'];
$observacao = $_POST['medicamento_observacao'];
$arquivoImagem = $_FILES['medicamento_foto'];

inserirmedicamento($conexao, $nome, $laboratorio, $categoria, $observacao, $arquivoImagem);

header('Location: index.php');
exit();

?>
