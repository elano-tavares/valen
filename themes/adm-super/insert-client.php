<?php
$this->layout("_theme");
?>

   
<div id="login-container">

    <h1>Criar Novo Cliente</h1>
    <form action="" id="form-client" method="POST">

        <label for="name">Nome</label>
        <input type="name" name="name" id="name" placeholder="Insira o nome da sua Prefeitura" autocomplete="off">

        <label for="cnpj">Cnpj</label>
        <input type="cnpj" name="cnpj" id="cnpj" placeholder="Insira o CNPJ da sua Prefeitura">

        <label for="state">Estado</label>
        <input type="state" name="state" id="state" placeholder="Insira o Estado da sua Prefeitura">

        <label for="nation">Nação</label>
        <input type="nation" name="nation" id="nation" placeholder="Insira a Nação da sua Prefeitura">

        <label for="description">Descrição</label>
        <input type="description" name="description" id="description" placeholder="Insira a descrição da sua Prefeitura">

        <label for="link">Link</label>
        <input type="link" name="link" id="link" placeholder="Insira o link da sua Prefeitura">
        
        <input id="button" type="submit" value="criar">

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
            const data = await fetch("<?= url("adm-super/novo-cliente"); ?>",{
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