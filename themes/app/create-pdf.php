<?php

// reference the Dompdf namespace
use Dompdf\Dompdf;
use Source\Models\User;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$user = new User();

$users = $_SESSION['user'];
$imprimi = json_encode($users);

$dompdf->loadHtml('<h1>Name</h1>' . $_SESSION['user']['id']);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("MeuPrimeiroPDF");