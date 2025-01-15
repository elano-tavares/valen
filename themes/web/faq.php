<?php
$this->layout("_theme");
?>
<!--=========================
=            FAQ            =
==========================-->

<section class="section faq">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h1>Perguntas <span class="alternate">Frequentes</span></h1>
                    <p>Se você está com alguma dúvida, procure por respostas aqui. Se você não encontrou uma resposta,
                        entre em contato conosco <a href="<?= url("contato"); ?>">AQUI!</a></p>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="accordion-block">
                    <div id="accordion">
                        <!-- Collapse -->

                            <?php
                            foreach ($faqs as $faq) {
                            ?>

                            <div class="card">
                                <!-- Collapse Header -->
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <p><?= $faq->question;?></p>
                                    </h5>
                                </div>
                                <!-- Collapse Body -->
                                <div class="collapse show" data-parent="#accordion">
                                <div class="card-body">
                                    <p><?= $faq->answer;?></p>
                                </div>
                                </div>
                        </div>
                                    
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<br>

<!--====  End of FAQ  ====-->