<?php 
$this->layout("_theme");
?>

<div class="d-flex flex-wrap bd-highlight">

<?php

if (!empty($notes)) {
    foreach ($notes as $note) {

?>

<div class="card border-dark p-2 m-3 badge-warning" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title"><?= $note->name; ?></h5>
    <h6 class="card-subtitle mb-2 text-muted"><?= $note->time; ?></h6>
    <p class="card-text"><?= $note->description; ?></p>
    <a href="#" class="card-link">excluir</a>
    <a href="#" class="card-link">atualizar</a>
  </div>
</div>

<?php
    }
}
?>
</div>

<div class="container">
    <form enctype="multipart/form-data" method="post" id="formNote">
        <div class="mb-3">
            <label for="name" class="form-label">Nome da Nota: </label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Informe um nome para sua nota...">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descrição: </label>
            <input type="text" name="description" class="form-control" id="description" placeholder="Descreva o que você não deseja esquecer...">
        </div>
        <div class="mb-3">
            <label for="time" class="form-label">Prazo/Data: </label>
            <input type="text" name="time" class="form-control" id="time" placeholder="Informe uma data para sua nota...">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary" name="send">Alterar</button>
        </div>
        <div class="alert alert-primary" role="alert" id="message">
            Mensagem de Retorno!
        </div>
    </form>
</div>
<script type="text/javascript" async>
    const form = document.querySelector("#formNote");
    const message = document.querySelector("#message");
    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const dataNote = new FormData(form);
        const data = await fetch("<?= url("app/notas"); ?>",{
            method: "POST",
            body: dataNote,
        });
        const note = await data.json();
        console.log(note);
        if(note) {
            message.textContent = note.message;
            message.classList.remove("alert-primary", "alert-danger");
            message.classList.add(`${note.type}`);
        }
    });
</script>