<?php

session_start();

require_once "funcoes.php";

verificarLogin();

if (isset($_GET["deletar"])) {

    deletarprescricao(
        $conexao,
        $_GET["medicamento_id"],
        $_GET["cuidado_id"],
        $_GET["pessoa_id"],
        $_GET["cuidador"]
    );

    header("Location: prescricao.php");
    exit;
}

$prescricoes = listarprescricao($conexao);

require_once "cabecalho.php";

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <title>Prescrições</title>

</head>

<body>

<h1>Prescrições</h1>

<?php while ($p = $prescricoes->fetch_assoc()) { ?>

    <div class="card">

        <p>
            Frequência:
            <?php echo $p["prescricao_frequencia"]; ?>
        </p>

        <p>
            Dosagem:
            <?php echo $p["prescricao_dosagem"]; ?>
        </p>

        <p>
            Horário:
            <?php echo $p["prescricao_horario_primeira_dose"]; ?>
        </p>

        <p>
            Data:
            <?php echo $p["prescricao_data_inicio"]; ?>
        </p>

        <p>
            Observação:
            <?php echo $p["prescricao_observacao"]; ?>
        </p>

        <a href="prescricao.php?deletar=1
        &medicamento_id=<?php echo $p["medicamento_medicamento_id"]; ?>
        &cuidado_id=<?php echo $p["cuidado_cuidado_id"]; ?>
        &pessoa_id=<?php echo $p["cuidado_fk_pessoa_pessoa_id"]; ?>
        &cuidador=<?php echo $p["cuidado_fk_pessoa_cuidador"]; ?>"
        onclick="return confirm('Deseja deletar?')">

            Deletar

        </a>

    </div>

<?php } ?>

</body>

</html>
