<?php
$this->layout("_theme");
?>

<div id="login-container">

    <h1>Apagar Arquivo</h1>
    <form action="" id="form-archive" method="POST">

        <label for="id">ID</label>
        <input type="id" name="id" id="id" placeholder="Insira o ID da Arquivo">

        <input id="button" type="submit" value="Apagar">

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
            const data = await fetch("<?= url("adm/apagar-arquivo"); ?>",{
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