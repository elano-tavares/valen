<?php
$this->layout("_theme");
?>

<div id="register-container">

        <h1>Cadastre-se</h1>
        <form action="" id="form-register" name="cadastro" method="POST">

            <label for="nome">Nome</label><br>
            <input type="text" name="name" id="name" placeholder="Insira seu nome" autocomplete="off"><br>

            <label for="email">E-mail</label><br>
            <input type="email" name="email" id="email" placeholder="Insira seu e-mail" autocomplete="off"><br>

            <label for="id_client">Número de identificação (Prefeitura)</label><br>
            <input type="number" name="id_client" id="id_client" placeholder="Insira o ID da sua Prefeitura" autocomplete="off"><br>

            <label for="password">Senha</label><br>
            <input type="password" name="password" id="senha" placeholder="Insira sua senha"><br>

            <input id="button" type="submit" value="Criar Conta">

            <div class="col-12" id="message">
            <!-- Aqui aparece a mensagem, caso ocorra erro! -->
            </div>

        </form>

        <script type="text/javascript" async>
            const form = document.querySelector("#form-register");
            const message = document.querySelector("#message");
            form.addEventListener("submit", async (e) => {
                e.preventDefault();
                const dataUser = new FormData(form);
                const data = await fetch("<?= url("registrar"); ?>",{
                    method: "POST",
                    body: dataUser,
                });
                const user = await data.json();
                console.log(user);
                if(user) {
                    message.innerHTML = user.message;
                    message.classList.add("message");
                    message.classList.remove("success", "warning", "error");
                    message.classList.add(`${user.type}`);
                }
                });
            </script>

    </div>