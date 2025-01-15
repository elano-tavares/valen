<?php 
$this->layout("_theme");
?>
<div class="text-center">
    <p class="h1 text-body">Arquivos</p> 
</div>


<div class="d-flex flex-wrap bd-highlight">

<?php

if (!empty($archives)) {
    foreach ($archives as $archive) {

?>

<div class="card border-dark p-2 m-3 badge-secondary" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title"><?= $archive->name; ?></h5>
    <h6 class="card-subtitle mb-2 text-info">Categoria: <b><?= $archive->category; ?></b></h6>
    <p class="card-text"><?= $archive->description; ?></p>
    <a href="#" class="card-link"><p class="text-right">baixar</p></a>
  </div>
</div>

<?php
    }
}
?>
</div>



