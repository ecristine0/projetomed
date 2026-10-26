<?php

session_start();

require_once "funcoes.php";

$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"] ?? "");
    $senha = $_POST["senha"] ?? "";

    if ($email === "" || $senha === "") {

        $erro = "Preencha o e-mail e a senha.";

    } else {

        $resultado = login($conexao, $email, $senha);

        if ($resultado === true) {

            // O login foi realizado com sucesso.
            // A função login() já armazenou os dados do usuário na sessão.
            header("Location: index.php");
            exit;

        } elseif ($resultado === false) {

            $erro = "E-mail ou senha incorretos.";

        } else {

            $erro = "Ocorreu um erro ao realizar o login.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - MedTime</title>

    <link rel="stylesheet" href="style.css">

    <style>

        .invalido {
            color: red;
        }

        .valido {
            color: green;
            font-weight: bold;
        }

    </style>

</head>

<body>

    <main class="login-page">

        <section class="login-container">

            <div class="login-header">

                <h1>Entrar</h1>

                <p>Acesse sua conta MedTime</p>

            </div>


            <?php if ($erro !== ""): ?>

                <div class="login-error">
                    <?= htmlspecialchars($erro) ?>
                </div>

            <?php endif; ?>


            <form
                action="login.php"
                method="POST"
                class="login-form"
            >


                <div class="form-group">

                    <label for="email">
                        E-mail
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Digite seu e-mail"
                        required
                    >

                </div>


                <div class="form-group">

                    <label for="senha">
                        Senha
                    </label>

                    <input
                        type="password"
                        id="senha"
                        name="senha"
                        placeholder="Digite sua senha"
                        required
                    >


                    <ul>

                        <li
                            id="regra_quantidade"
                            class="invalido"
                        >
                            no mínimo oito caracteres
                        </li>

                        <li
                            id="regra_maiuscula"
                            class="invalido"
                        >
                            no mínimo uma letra maiúscula
                        </li>


                    </ul>

                </div>


                <button
                    type="submit"
                    class="login-button"
                >
                    Entrar
                </button>

            </form>


            <div class="login-footer">

                <p>
                    Não possui uma conta?

                    <a href="cadastrar.php">
                        Cadastre-se
                    </a>

                </p>


                <a
                    href="index.php"
                    class="back-link"
                >
                    Voltar para o início
                </a>

            </div>

        </section>

    </main>


    <script>

        const campo_senha =
            document.getElementById('senha');


        const regraquantidade =
            document.getElementById('regra_quantidade');


        const regramaiusculo =
            document.getElementById('regra_maiuscula');



        function validarRegra(valor, regra) {

            if (valor) {

                regra.classList.remove('invalido');

                regra.classList.add('valido');

            } else {

                regra.classList.remove('valido');

                regra.classList.add('invalido');

            }

        }


        campo_senha.addEventListener('input', () => {

            const quantidade =
                campo_senha.value.length >= 8;


            const maiusculo =
                /[A-Z]/.test(campo_senha.value);



            validarRegra(quantidade, regraquantidade);

            validarRegra(maiusculo,regramaiusculo);


        });

    </script>

</body>

</html>
