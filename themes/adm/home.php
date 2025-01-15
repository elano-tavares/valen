<?php
$this->layout("_theme");
?>

<div class="">
<h1 class="text-center"><b>--<?= $_SESSION["client"]["name"] ?>--</b></h1>
<h2 class="text-center"><b>ID:</b> <?= $_SESSION["client"]["id"] ?></h2>
<h2 class="text-center"><b>CNPJ:</b> <?= $_SESSION["client"]["cnpj"] ?></h2>
<h2 class="text-center"><b>ESTADO:</b> <?= $_SESSION["client"]["state"] ?></h2>
<h2 class="text-center"><b>NAÇÃO:</b> <?= $_SESSION["client"]["nation"] ?></h2>
</div>
