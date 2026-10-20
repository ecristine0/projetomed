<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastro - MedTime</title>

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

    <main class="cadastro-page">

        <section class="cadastro-container">

            <div class="cadastro-header">

                <h1>Criar conta</h1>

                <p>
                    Preencha seus dados para criar sua conta no MedTime.
                </p>

            </div>


            <form
                action="salvar_cadastro.php"
                method="POST"
                class="cadastro-form"
                id="formCadastro"
            >


                <div class="cadastro-form-group">

                    <label for="pessoa_nome">
                        Nome:
                    </label>

                    <input
                        type="text"
                        id="pessoa_nome"
                        name="pessoa_nome"
                        placeholder="Ex.: Maria da Silva"
                        required
                    >

                </div>


                <div class="cadastro-form-group">

                    <label for="pessoa_email">
                        E-mail:
                    </label>

                    <input
                        type="email"
                        id="pessoa_email"
                        name="pessoa_email"
                        placeholder="Ex.: maria@email.com"
                        required
                    >

                </div>


                <div class="cadastro-form-group">

                    <label for="pessoa_senha">
                        Senha:
                    </label>

                    <input
                        type="password"
                        id="pessoa_senha"
                        name="pessoa_senha"
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


                <div class="cadastro-form-group">

                    <label for="pessoa_tipo">
                        Tipo de usuário:
                    </label>

                    <select
                        id="pessoa_tipo"
                        name="pessoa_tipo"
                        required
                    >

                        <option value="">
                            Selecione uma opção
                        </option>

                        <option value="cuidador">
                            Cuidador
                        </option>

                        <option value="paciente">
                            Paciente
                        </option>

                    </select>

                </div>


                <div class="cadastro-form-group">

                    <label for="pessoa_data_nascimento">
                        Data de nascimento:
                    </label>

                    <input
                        type="date"
                        id="pessoa_data_nascimento"
                        name="pessoa_data_nascimento"
                        required
                    >

                </div>


                <div class="cadastro-form-group">

                    <label for="pessoa_peso">
                        Peso:
                    </label>

                    <input
                        type="number"
                        id="pessoa_peso"
                        name="pessoa_peso"
                        placeholder="Ex.: 70.5 kg"
                        step="0.1"
                        min="0"
                        required
                    >

                </div>


                <div class="cadastro-form-group">

                    <label for="pessoa_altura">
                        Altura:
                    </label>

                    <input
                        type="number"
                        id="pessoa_altura"
                        name="pessoa_altura"
                        placeholder="Ex.: 1.70 m"
                        step="0.01"
                        min="0"
                        required
                    >

                </div>


                <button
                    type="submit"
                    class="cadastro-button"
                >
                    Criar conta
                </button>


            </form>


            <div class="cadastro-footer">

                <p>

                    Já possui uma conta?

                    <a href="login.php">
                        Entre aqui
                    </a>

                </p>


                <a
                    href="index.php"
                    class="cadastro-back-link"
                >
                    Voltar para o início
                </a>

            </div>

        </section>

    </main>


    <script>

        const campo_senha =
            document.getElementById('pessoa_senha');


        const regraquantidade =
            document.getElementById('regra_quantidade');


        const regramaiusculo =
            document.getElementById('regra_maiuscula');


        const regranumero =
            document.getElementById('regra_numero');


        const regraespecial =
            document.getElementById('regra_especial');


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


            const numero =
                /[0-9]/.test(campo_senha.value);


            const especial =
                /[!@#$%^&*()-+]/.test(campo_senha.value);


            validarRegra(quantidade,regraquantidade);

            validarRegra(maiusculo, regramaiusculo);

            validarRegra(numero, regranumero);


            validarRegra(especial, regraespecial);
        
        });

    </script>

</body>

</html>
