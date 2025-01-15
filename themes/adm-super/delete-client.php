<?php
$this->layout("_theme");
?>

<div id="login-container">

    <h1>Apagar Cliente</h1>
    <form action="" id="form-client" method="POST">

        <label for="cnpj">Cnpj</label>
        <input type="cnpj" name="cnpj" id="cnpj" placeholder="Insira o CNPJ da Prefeitura">

        <label for="id">ID</label>
        <input type="id" name="id" id="id" placeholder="Insira o ID da Prefeitura" autocomplete="off">

        <input id="button" type="submit" value="Apagar">

        <div class="col-12" id="message">
        <!-- Aqui aparece a mensagem, caso ocorra erro! -->
        </div>

    </form>
</div>


<script type="text/javascript" async>
        const form = document.querySelector("#form-client");
        const message = document.querySelector("#message");
        form.addEventListener("submit", async (e) => {
            e.preventDefault();
            const dataClient = new FormData(form);
            const data = await fetch("<?= url("adm-super/apagar-cliente"); ?>",{
                method: "POST",
                body: dataClient,
            });
            const client = await data.json();
            console.log(client);
            if(client) {
                message.innerHTML = client.message;
                message.classList.add("message");
                message.classList.remove("success", "warning", "error");
                message.classList.add(`${client.type}`);
            }
        });
    </script>