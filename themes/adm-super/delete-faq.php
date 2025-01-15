<?php
$this->layout("_theme");
?>


<div id="login-container">

    <h1>Apagar FAQ</h1>
    <form action="" id="form-faq" method="POST">

        <label for="id">ID</label>
        <input type="id" name="id" id="id" placeholder="Insira o ID da FAQ">

        <input id="button" type="submit" value="Apagar">

        <div class="col-12" id="message">
        <!-- Aqui aparece a mensagem, caso ocorra erro! -->
        </div>

    </form>
</div>


<script type="text/javascript" async>
        const form = document.querySelector("#form-faq");
        const message = document.querySelector("#message");
        form.addEventListener("submit", async (e) => {
            e.preventDefault();
            const dataFaq = new FormData(form);
            const data = await fetch("<?= url("adm-super/apagar-faq"); ?>",{
                method: "POST",
                body: dataFaq,
            });
            const faq = await data.json();
            console.log(faq);
            if(faq) {
                message.innerHTML = faq.message;
                message.classList.add("message");
                message.classList.remove("success", "warning", "error");
                message.classList.add(`${faq.type}`);
            }
        });
    </script>