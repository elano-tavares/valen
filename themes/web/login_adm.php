<?php
$this->layout("_theme");
?>

    
<div id="login-container">

    <h1>Login de Administrador</h1>
    <form action="" id="form-adm" method="POST">

        <label for="cnpj">CNPJ:</label>
        <input type="text" name="cnpj" id="cnpj" placeholder="Insira seu CNPJ" autocomplete="off">

        <label for="id">Número de identificação (Prefeitura)</label>
        <input type="number" name="id" id="id" placeholder="Insira o ID da sua Prefeitura">

        <input id="butun" type="submit" value="login">
        
        <div class="col-12" id="message">
        <!-- Aqui aparece a mensagem, caso ocorra erro! -->
        </div> 
    </form>
</div>

<script type="text/javascript" async>
        const form = document.querySelector("#form-adm");
        const message = document.querySelector("#message");
        form.addEventListener("submit", async (e) => {
            e.preventDefault();
            const dataUser = new FormData(form);
            const data = await fetch("<?= url("entrar-adm"); ?>",{
                method: "POST",
                body: dataUser,
            });
            const user = await data.json();
            console.log(user);
            if(user) {
                if(user.type == "success"){
                    window.location.href = "http://www.localhost/valen/adm/";
                } else if (user.type == "success-adm"){
                    window.location.href = "http://www.localhost/valen/adm-super/";
                } else {
                    message.innerHTML = user.message;
                }
                message.classList.add("message");
                message.classList.remove("success", "warning", "error");
                message.classList.add(`${user.type}`);
            }
        });
    </script>