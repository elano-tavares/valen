<?php 
$this->layout("_theme");
?>

<h1 class="text-center"> Seja Bem-Vindo, <?= $user->getName(); ?> da <?= $client_Name->name; ?>!<br> Conheça abaixo todos os usuários do nosso Sitema.</h1> 

<?php

foreach($clients_All as $client){

?>

<div class="card text-center">
  <div class="card-header">
    <?= $client->name; ?>
  </div>
  <div class="card-body">
    <h5 class="card-title"><?= $client->state; ?> <br> <?= $client->nation; ?></h5>
    <p class="card-text"><?= $client->description; ?></p> 
    <br> 
    <a href="<?= $client->link; ?>" class="btn btn-primary">Visitar</a>
  </div>
</div>

<?php
}
?>