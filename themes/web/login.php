<?php
$this->layout("_theme");
?>
    
<div id="login-container">

    <h1>Login</h1>
    <form action="" id="form-login" method="POST">

        <label for="email">E-mail</label>
        <input type="email" name="email" id="email_log" placeholder="Insira seu e-mail" autocomplete="off">

        <label for="password">Senha</label>
        <input type="password" name="password" id="senha_log" placeholder="Insira sua senha">

        <a href="#" id="forgot-pass">Esqueceu a senha?</a>

        <input id="butun" type="submit" value="login">
        
        <div class="col-12" id="message">
        <!-- Aqui aparece a mensagem, caso ocorra erro! -->
        </div>
        
    </form>
    <div id="register-container-login">
        <p>Ainda não tem uma conta?</p>
        <a href="<?= url("registrar"); ?>">Registre-se</a>
    </div> 
</div>

<script type="text/javascript" async>
        const form = document.querySelector("#form-login");
        const message = document.querySelector("#message");
        form.addEventListener("submit", async (e) => {
            e.preventDefault();
            const dataUser = new FormData(form);
            const data = await fetch("<?= url("entrar"); ?>",{
                method: "POST",
                body: dataUser,
            });
            const user = await data.json();
            console.log(user);
            if(user) {
                if(user.type == "success"){
                   window.location.href = "http://www.localhost/valen/app/";
                } else {
                    message.innerHTML = user.message;
                }
                message.classList.add("message");
                message.classList.remove("success", "warning", "error");
                message.classList.add(`${user.type}`);
            }
        });
    </script>
