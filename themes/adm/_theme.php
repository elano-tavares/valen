<!DOCTYPE html>
<html lang="pt-br">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Valen</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" href="<?= url("assets/web/"); ?>css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" href="<?= url("assets/web/"); ?>css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="<?= url("assets/web/"); ?>css/responsive.css">
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="<?= url("assets/web/"); ?>css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
   </head>
   <!-- body -->
   <body class="main-layout">
      <!-- loader  -->
      <div class="loader_bg">
         <div class="loader"><img src="<?= url("assets/web/"); ?>images/loading.gif" alt="#" /></div>
      </div>
      <!-- end loader -->
      <!-- header -->
      <header>
         <!-- header inner -->
         <div class="header">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                     <div class="full">
                        <div class="logo">
                           <a href="<?= url(""); ?>"><img src="<?= url("assets/web/"); ?>images/logo_1.png" alt="#" /></a>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10">
                     <nav class="navigation navbar navbar-expand-md navbar-dark ">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarsExample04">
                           <ul class="navbar-nav mr-auto">
                              <li class="nav-item active">
                                 <a class="nav-link" href="<?= url("adm/"); ?>">Informações Gerais</a>
                              </li>
                              <li class="nav-item">
                              <div class="btn-group ml-4">
                              <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 Editar
                                 </button>
                                    <div class="dropdown-menu">
                                    <a class="dropdown-item" href="<?= url("adm/apagar-usuario"); ?>">Deletar Usuário</a>
                                    <a class="dropdown-item" href="<?= url("adm/novo-arquivo"); ?>">Inserir Arquvivo</a>
                                    <a class="dropdown-item" href="<?= url("adm/apagar-arquivo"); ?>">Deletar Arquivo</a>
                                 </div>
                                 </div>
                              </li>
                           </ul>
                        </div>
                     </nav>
                     <div class="right_button">
                     <div class="btn-group">
                     <div class="btn-group dropleft" role="group">
                        <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <span class="sr-only">Dropleft</span>
                        </button>
                        <div class="dropdown-menu">
                           <a class="dropdown-item text-dark" href="<?= url("adm/sair"); ?>">Sair</a>
                        </div>
                     </div>
                     <button type="button" class="btn btn-warning">
                     <a href="<?= url("entrar"); ?>"><i class="fa fa-user" aria-hidden="true"></i></a>
                     </button>
                     </div>
                  </div>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <!-- end header inner -->
      <!-- end header -->

      <?= $this->section("content"); ?>
      
      <!--  footer -->
      <footer>
         <div class="footer">
            <div class="container">
               <div class="row">
                  <div class="col-md-5">
                     <a class="logo2" href="<?= url("") ?>"><img src="<?= url("assets/web/"); ?>images/logo_2.png" alt="#"/></a>
                     <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it  </p>
                  </div>
                  <div class="col-md-3">
                     <div class="fid_box">
                        <h3>Links Úteis</h3>
                        <ul class="use_link">
                           <li class="active"><a  href="<?= url(""); ?>">Página Principal</a></li>
                           <li><a href="<?= url("sobre"); ?>">Sobre</a></li>
                           <li><a href="<?= url("contato"); ?>">Contato</a></li>
                        </ul>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="fid_box">
                        <h3>Contato</h3>
                        <ul class="location_icon">
                           <li><a href="Javascript:void(0)"><i class="fa fa-map-marker" aria-hidden="true"></i></a><br> It is a long established fact that a <br>reader will be distracted</li>
                           <li><a href="Javascript:void(0)"><i class="fa fa-phone" aria-hidden="true"></i></a><br>
                              (+51) 9-9618-4659<br> (+51) 9-9618-4659
                           </li>
                           <li><a href="Javascript:void(0)"><i class="fa fa-envelope" aria-hidden="true"></i></a><br>elano.tavares.ncs@gmail.com</li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12 margin_topv">
                     <h3 class="neslatter">Inscreva-se para novas notícias</h3>
                     <form class="news_form">
                        <input class="letter_form" placeholder="Enviar seu email" type="text" name="Enter your email">
                        <button class="sumbit">Inscrever-se</button>
                     </form>
                  </div>
               </div>
            </div>
            <div class="copyright">
               <div class="container">
                  <div class="row">
                     <div class="col-md-12">
                        <p>© 2022 Todos os Direitos Reservados. Design de Elano Tavares</a></p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </footer>
      <!-- end footer -->
      <!-- Javascript files-->
      <script src="<?= url("assets/web/"); ?>js/jquery.min.js"></script>
      <script src="<?= url("assets/web/"); ?>js/popper.min.js"></script>
      <script src="<?= url("assets/web/"); ?>js/bootstrap.bundle.min.js"></script>
      <script src="<?= url("assets/web/"); ?>js/jquery-3.0.0.min.js"></script>
      <!-- sidebar -->
      <script src="<?= url("assets/web/"); ?>js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="<?= url("assets/web/"); ?>js/customs.js"></script>
      <script>
         function openNav() {
           document.getElementById("mySidepanel").style.width = "250px";
         }
         
         function closeNav() {
           document.getElementById("mySidepanel").style.width = "0";
         }
      </script>
      <script>
         // This example adds a marker to indicate the position of Bondi Beach in Sydney,
         // Australia.
         function initMap() {
           var map = new google.maps.Map(document.getElementById('map'), {
             zoom: 11,
             center: {lat: 40.645037, lng: -73.880224},
             });
         
         var image = '<?= url("assets/web/"); ?>images/maps-and-flags.png';
         var beachMarker = new google.maps.Marker({
             position: {lat: 40.645037, lng: -73.880224},
             map: map,
             icon: image
           });
         }
      </script>
      <!-- google map js -->
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8eaHt9Dh5H57Zh0xVTqxVdBFCvFMqFjQ&callback=initMap"></script>
      <!-- end google map js --> 
   </body>
</html>

