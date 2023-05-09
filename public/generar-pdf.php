<?php
require __DIR__ . '../../vendor/autoload.php';
// use \setasign\Fpdi\Fpdi;
use setasign\Fpdi\Fpdi;
// Inicializa pdf
$pdf = new Fpdi();
$pdf->AddPage('L'); // adaptar para pdf
$pdf->setSourceFile("../public/storage/tercero.pdf");
// seleccion de pagina
$tplId = $pdf->importPage(1);
$pdf->useTemplate($tplId, 0, 0, 298); // tamaño pdf
$pdf->SetFont('Arial','',23); // tipo de letra y tañaño
$pdf->SetTextColor(0,0,0); // RGB
// $nombre = $_GET['name'];
$pdf->Cell(0,174,$_GET['name'],0,0,'C');
$pdf->Output();

// $text = "Moises David Canaria Martinez";
// $pdf->Write(0, $text);
// // Añadir nuevo texto 
// $pdf->SetFont('Arial','',12); 
// $pdf->SetTextColor(0,0,0); 
// $pdf->SetXY(170, 150); 
// $date = date('F dS, Y'); fecha
// $pdf->Write(0, $date);

$pdf->Output();

?>
