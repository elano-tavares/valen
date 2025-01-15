<?php
$this->layout("_theme");
?>

<div class="card m-5 ">
  <div class="card-header text-center font-weight-bold">
    Relatório de Usuários
  </div>
  <div class="card-body text-center">
    <h5 class="card-title text-center font-weight-bold mt-2">Relatório de usuários de todas as prefeituras do sistema Valen.</h5>
    <form id="form-button" method="post">
    <a href="<?= url("adm-super/pdf") ?>" class="btn btn-warning">Baixar</a>
  </div>
</div>