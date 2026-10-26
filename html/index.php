<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MedTime</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<?php require_once "cabecalho.php"; ?>

<main>

    <div class="hero">

        <div class="container">

            <div class="texto">

                <h5>Cuide da sua saúde com facilidade</h5>

                <h2>
                    Gerencie seus
                    <span>medicamentos</span>
                    de forma simples
                </h2>

                <p>
                    O MedTime ajuda você a manter o controle da sua medicação,
                    garantindo que cada dose seja tomada no momento certo.
                </p>

                <button>
                    Começar Agora →
                </button>

            </div>

            <div class="imagem">

                <img src="foto/remediocapa.png" alt="Imagem medicamentos">

            </div>

        </div>

    </div>

    <div class="estatisticas">

        <div class="container">

            <div>
                <h3>98%</h3>
                <p>Taxa de Adesão</p>
            </div>

            <div>
                <h3>24/7</h3>
                <p>Monitoramento</p>
            </div>

            <div>
                <h3>100%</h3>
                <p>Seguro</p>
            </div>

        </div>

    </div>

    <div class="funcionalidades">

        <div class="container">

            <h2>Por que escolher o MedTime?</h2>

            <p class="subtitulo">
                Funcionalidades pensadas para sua saúde
            </p>

            <div class="cards">

                <div class="card">

                    <div class="card-titulo">

                        <img src="foto/reloginho.jpg" alt="Ícone lembrete">

                        <h4>Lembretes Inteligentes</h4>

                    </div>

                    <p>
                        Nunca esqueça seus medicamentos
                        com notificações personalizadas.
                    </p>

                </div>

                <div class="card">

                    <div class="card-titulo">

                        <img src="foto/calendariozinho.jpg" alt="Ícone calendário">

                        <h4>Calendário de Doses</h4>

                    </div>

                    <p>
                        Visualize sua programação de medicamentos
                        em um só lugar.
                    </p>

                </div>

                <div class="card">

                    <div class="card-titulo">

                        <img src="foto/segurancinha.jpg" alt="Ícone segurança">

                        <h4>Seguro e Privado</h4>

                    </div>

                    <p>
                        Seus dados de saúde permanecem protegidos.
                    </p>

                </div>

            </div>

        </div>

    </div>
    <h3>Informações</h3>
<h3>Informações</h3>

<div class="input">

    <p class="form">Medicamento</p>

    <select name="medicamento_medicamento_id">

        <?php
        $sql = "SELECT * FROM medicamento";

        $comando = mysqli_prepare($conexao, $sql);

        mysqli_stmt_execute($comando);

        $resultados = mysqli_stmt_get_result($comando);

        while ($medicamento = mysqli_fetch_assoc($resultados)) {

            $id = $medicamento['medicamento_id'];
            $nome = $medicamento['medicamento_nome'];

            echo "<option value='$id'>$nome</option>";
        }

        mysqli_stmt_close($comando);
        ?>

    </select>

    <br>

</div>
    <p class="form">Cuidado</p>

    <select name="cuidado_cuidado_id">
        <?php
        $sql = "SELECT * FROM cuidado";
        $comando = mysqli_prepare($conexao, $sql);
        mysqli_stmt_execute($comando);
        $resultados = mysqli_stmt_get_result($comando);

        while ($cuidado = mysqli_fetch_assoc($resultados)) {
            $id = $cuidado['cuidado_id'];

            echo "<option value='$id'>$id</option>";
        }

        mysqli_stmt_close($comando);
        ?>
    </select>
</div>
2. Menu de Pessoa

php
<div class="input">
    <p class="form">Pessoa</p>

    <select name="pessoa_id">
        <?php
        $sql = "SELECT * FROM pessoa";
        $comando = mysqli_prepare($conexao, $sql);
        mysqli_stmt_execute($comando);
        $resultados = mysqli_stmt_get_result($comando);

        while ($pessoa = mysqli_fetch_assoc($resultados)) {
            $id = $pessoa['pessoa_id'];
            $nome = $pessoa['pessoa_nome'];

            echo "<option value='$id'>$nome</option>";
        }

        mysqli_stmt_close($comando);
        ?>
    </select>
</div>
3. Menu de Cuidador

php
<div class="input">
    <p class="form">Cuidador</p>

    <select name="cuidador">
        <?php
        $sql = "SELECT * FROM cuidador";
        $comando = mysqli_prepare($conexao, $sql);
        mysqli_stmt_execute($comando);
        $resultados = mysqli_stmt_get_result($comando);

        while ($cuidador = mysqli_fetch_assoc($resultados)) {
            $id = $cuidador['cuidador_id'];
            $nome = $cuidador['cuidador_nome'];

            echo "<option value='$id'>$nome</option>";
        }

        mysqli_stmt_close($comando);
        ?>
    </select>
</div>

    <div class="cta">

        <h2>Pronto para começar?</h2>

        <p>
            Cuide melhor da sua saúde com o MedTime.
        </p>

        <button>
            <a href="login.php">Cadastre</a>
        </button>

    </div>

</main>

<footer>

    <div class="container">
        <?php require_once "rodape.php"; ?>
    </div>

</footer>

</body>

</html>