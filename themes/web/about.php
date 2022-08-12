<?php $this->layout("_theme"); ?>
<div>
    <h1>Página Sobre - Meu about</h1>
    <div>
        Texto/Conteúdo da página sobre!
    </div>
    <div>
        Meu nome é <?php echo $name; ?>
        Idade <?php echo $age; ?>
    </div>
    <div>
        Meu nome é <?= $name; ?>
        Idade <?= $age; ?>
    </div>
    <div>
        Teste da função url:  <?= url("assets/css"); ?>
    </div>
</div>