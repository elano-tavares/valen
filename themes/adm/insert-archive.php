<?php
$this->layout("_theme");
?>

<div id="login-container">

    <h1>Insira Novos Arquivos</h1>
    <form action="" id="form-archive" method="POST">

        <label for="id_client">ID da Prefeitura a qual o arquivo pertence</label>
        <input type="id_client" name="id_client" id="id_client" placeholder="Insira o ID da sua Prefeitura" autocomplete="off">

        <label for="name">Nome do Arquivo</label>
        <input type="name" name="name" id="name" placeholder="Insira o nome do seu arquivo">

        <label for="description">Descrição</label>
        <input type="description" name="description" id="description" placeholder="Insira a descrição do seu arquivo">

        <label for="category">Categoria</label>
        <input type="category" name="category" id="category" placeholder="Insira a categoria do seu arquivo">
        
        <input id="button" type="submit" value="criar">

        <div class="col-12" id="message">
        <!-- Aqui aparece a mensagem, caso ocorra erro! -->
        </div>

    </form>

</div>

<script type="text/javascript" async>
        const form = document.querySelector("#form-archive");
        const message = document.querySelector("#message");
        form.addEventListener("submit", async (e) => {
            e.preventDefault();
            const dataArchive = new FormData(form);
            const data = await fetch("<?= url("adm/novo-arquivo"); ?>",{
                method: "POST",
                body: dataArchive,
            });
            const archive = await data.json();
            console.log(archive);
            if(archive) {
                message.innerHTML = archive.message;
                message.classList.add("message");
                message.classList.remove("success", "warning", "error");
                message.classList.add(`${archive.type}`);
            }
        });
    </script>