<?php

require_once "conexao.php";
require_once "funcoes.php";


// Recebe os dados enviados pelo formulário.
$nome = trim($_POST["pessoa_nome"] ?? "");
$email = trim($_POST["pessoa_email"] ?? "");
$senha = $_POST["pessoa_senha"] ?? "";
$tipo = trim($_POST["pessoa_tipo"] ?? "");
$data_nascimento = $_POST["pessoa_data_nascimento"] ?? "";
$peso = $_POST["pessoa_peso"] ?? "";
$altura = $_POST["pessoa_altura"] ?? "";


// Verifica se todos os campos foram preenchidos.
if (
    $nome === "" ||
    $email === "" ||
    $senha === "" ||
    $tipo === "" ||
    $data_nascimento === "" ||
    $peso === "" ||
    $altura === ""
) {

    die("Preencha todos os campos do cadastro.");

}


// Verifica se o e-mail já está cadastrado.
$sql = "SELECT pessoa_id
        FROM banco.pessoa
        WHERE pessoa_email = ?";

$stmt = $conexao->prepare($sql);

$stmt->bind_param("s", $email);

$stmt->execute();

$resultado = $stmt->get_result();


if ($resultado->num_rows > 0) {

    die("Este e-mail já está cadastrado.");

}


// Cadastra a nova pessoa no banco.
if (
    inserirpessoa(
        $conexao,
        $nome,
        $email,
        $senha,
        $tipo,
        $data_nascimento,
        $peso,
        $altura
    )
) {

    // Depois do cadastro, o usuário volta para a tela de login.
    header("Location: login.php");
    exit;

} else {

    die("Erro ao realizar o cadastro.");

}

?>