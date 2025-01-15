<?php
$this->layout("_theme");
?>

<div id="login-container">

    <h1>Apagar Usuário</h1>
    <form action="" id="form-user" method="POST">

        <label for="id">ID</label>
        <input type="id" name="id" id="id" placeholder="Insira o ID do Usuário">

        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Insira o seu email de Usuário">

        <input id="button" type="submit" value="Apagar">

        <div class="col-12" id="message">
        <!-- Aqui aparece a mensagem, caso ocorra erro! -->
        </div>

    </form>
</div>


<script type="text/javascript" async>
        const form = document.querySelector("#form-user");
        const message = document.querySelector("#message");
        form.addEventListener("submit", async (e) => {
            e.preventDefault();
            const dataUser = new FormData(form);
            const data = await fetch("<?= url("adm/apagar-usuario"); ?>",{
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