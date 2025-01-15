<?php

ob_start();

session_start();

require __DIR__ . "/vendor/autoload.php";
use CoffeeCode\Router\Router;

$route = new Router(CONF_URL_BASE, ":");

/**
 * Web Routes
 */

$route->namespace("Source\App");

$route->get("/","Web:home");

$route->get("/entrar","Web:login");
$route->post("/entrar","Web:login");

$route->get("/entrar-adm","Web:admin");
$route->post("/entrar-adm","Web:admin");

$route->get("/perguntas-frequentes", "Web:faq");

$route->get("/registrar","Web:register");
$route->post("/registrar","Web:register");

$route->get("/sobre","Web:about");

$route->get("/localizacao","Web:localization");
//$route->get("/projeto","Web:project");

$route->get("/contato","Web:contact");
$route->post("/contato","Web:contact");

/**
 * App Routs
 */

$route->group("/app"); // agrupa em /app
$route->get("/","App:home");
$route->get("/notas","App:note");
$route->get("/arquivos","App:archive");
$route->post("/notas","App:noteUpdate");
$route->get("/listar","App:list");
$route->get("/sair","App:logout");
$route->get("/pdf","App:createPDF");
$route->get("/perfil","App:profile");
$route->post("/perfil","App:profileUpdate");
$route->group(null); // desagrupo do /app

/**
 * Adm Routs
 */

$route->group("/adm"); // agrupa em /admin
$route->get("/","Adm:home");

$route->get("/apagar-usuario","Adm:deleteUser");
$route->post("/apagar-usuario","Adm:deleteUser");

$route->get("/novo-arquivo","Adm:newArchive");
$route->post("/novo-arquivo","Adm:newArchive");

$route->get("/apagar-arquivo","Adm:deleteArchive");
$route->post("/apagar-arquivo","Adm:deleteArchive");

$route->get("/sair","Adm:logout");
$route->group(null); // desagrupo do /admin

/**
 * Adm-Super Routs
 */

$route->group("/adm-super"); // agrupa em /admin
$route->get("/","AdmSuper:home");
$route->get("/pdf","AdmSuper:createPDF");
$route->get("/relatorio","AdmSuper:record");

$route->get("/novo-cliente","AdmSuper:newClient");
$route->post("/novo-cliente","AdmSuper:newClient");

$route->get("/apagar-cliente","AdmSuper:deleteClient");
$route->post("/apagar-cliente","AdmSuper:deleteClient");

$route->get("/novo-faq","AdmSuper:newFaq");
$route->post("/novo-faq","AdmSuper:newFaq");

$route->get("/apagar-faq","AdmSuper:deleteFaq");
$route->post("/apagar-faq","AdmSuper:deleteFaq");

$route->get("/sair","AdmSuper:logout");
$route->group(null); // desagrupo do /admin

/*
 * Erros Routes
 */

$route->group("error")->namespace("Source\App");
$route->get("/{errcode}", "Web:error");

$route->dispatch();

/*
 * Error Redirect
 */

if ($route->error()) {
    $route->redirect("/error/{$route->error()}");
}

ob_end_flush();