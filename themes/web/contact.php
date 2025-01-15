<?php
$this->layout("_theme");
?>

<div class="yellow_bg">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2><img src="<?= url("assets/web/"); ?>images/heading_iconw.png" alt="#"/>Contato</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- contact section -->
      <div id="contact" class="contact">
         <div class="con_bg">
            <div class="container-fluid">
               <div class="row ">
                  <div class="col-md-6">
                     <form id="request" class="main_form">
                        <div class="row">
                           <div class="col-md-12 ">
                              <input class="contactus" placeholder="Nome" type="type" name="Name"> 
                           </div>
                           <div class="col-md-12">
                              <input class="contactus" placeholder="Número de Telefone" type="type" name="Phone Number"> 
                           </div>
                           <div class="col-md-12">
                              <input class="contactus" placeholder="Email" type="type" name="Email">                          
                           </div>
                           <div class="col-md-12">
                              <input class="contactusmess" placeholder="Mensagem" type="type" Message="Name">
                           </div>
                           <div class="col-md-12">
                              <button class="send_btn">Enviar</button>
                           </div>
                        </div>
                     </form>
                  </div>
                  <div class="col-md-6 padding_right2">
                     <div class="map_section">
                        <div id="map">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <br><br>
      <!-- end contact section -->