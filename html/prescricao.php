<?php
session_start();
require_once 'funcoes.php';
verificarLogin();
require_once "cabecalho.php";


echo "<h2>Listar Prescrição</h2>";


$idoso = listarIdoso($conexao);

?>
