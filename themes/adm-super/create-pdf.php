<?php

// reference the Dompdf namespace
use Dompdf\Dompdf;
use Source\Models\User;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$user = new User();

$users = $user->selectAll();

$arrayUsers = [];
$cont = 0;

foreach ($users as $user){
    $cont += 1;
    array_push($arrayUsers, "<h2>" . $cont . " - { Nome: " . $user->name . "</h2>" .  "<h2>" . "ID: " .
    $user->id . "</h2>" . "<h2>" . "ID da Prefeitura: " . $user->id_client . "}</h2><br>");
}

$dompdf->loadHtml("<h1>Usuários do sistema:</h1>" . 
$arrayUsers[0] . $arrayUsers[1]);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("Relatorio_Usuarios");