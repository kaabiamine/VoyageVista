<?php
require_once '../../../cnx1.php';
include_once '../../../controller\ForfaitC.php'; // Fixed path
require_once '../../../model\Forfait.php';
require_once '../../../tcpdf\tcpdf.php';

// Create an instance of DestinationsC
$forfaitC = new ForfaitC(Cnx1::getConnexion());

// Fetch data from the database or use the existing data
$listeForfaits = $forfaitC->listForfaits();

// Create new PDF instance
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Set document information
$pdf->SetCreator('Your Name');
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Forfait Report');
$pdf->SetSubject('Forfait Report');

// Add a page
$pdf->AddPage();

// Add example logo as image
$pdf->Image('logo.jpg', 10, 10, 50, '', 'JPG');

// Add company name
$pdf->SetFont('helvetica', 'B', 12);
$pdf->SetXY(70, 15); // Set X and Y position for the company name
$pdf->Cell(0, 10, 'VOYAGEVISTA', 0, false, 'L', 0, '', 0, false, 'M', 'M');

// Set font
$pdf->SetFont('helvetica', '', 10);

// Calculate the center position for the table
$tableWidth = array_sum(array(30, 25, 25, 25, 35)); // Total width of all columns
$centerX = ($pdf->getPageWidth() - $tableWidth) / 2;

// Set X position to center the table horizontally
$pdf->SetX($centerX);

// Table header
$pdf->Ln(30); // Move down to make space for the company name and logo
$header = array('Localisation', 'Tarif', 'Saison', 'Horaire', 'Date');
$pdf->SetFillColor(200, 220, 255); // Header background color
$pdf->SetTextColor(0); // Text color
$pdf->SetDrawColor(0); // Border color
$pdf->SetLineWidth(0.3); // Border width
$pdf->SetFont('', 'B');
// Adjust the width of each column as needed
$pdf->Cell(30, 7, $header[0], 1, 0, 'C', 1); 
$pdf->Cell(25, 7, $header[1], 1, 0, 'C', 1); 
$pdf->Cell(25, 7, $header[2], 1, 0, 'C', 1); 
$pdf->Cell(25, 7, $header[3], 1, 0, 'C', 1);
$pdf->Cell(35, 7, $header[4], 1, 0, 'C', 1); 
$pdf->Ln();

// Table data
$pdf->SetFont('', '');
foreach ($listeForfaits as $forfait) {
    $pdf->SetFillColor(255, 255, 255); // Row background color
    // Adjust the width of each column as needed
    $pdf->Cell(30, 6, $forfait['nom_forfait'], 1, 0, 'C', 1); // Localisation
    $pdf->Cell(25, 6, $forfait['prix'], 1, 0, 'C', 1); // Tarif
    $pdf->Cell(25, 6, $forfait['date_depart'], 1, 0, 'C', 1); // Saison
    $pdf->Cell(25, 6, $forfait['date_retour'], 1, 0, 'C', 1); // Horaire
    $pdf->Cell(35, 6, $forfait['place_dispo'], 1, 0, 'C', 1); // Date
    $pdf->Ln();
}

// Output PDF as a download
$pdf->Output('forfait_report.pdf', 'D');
?>
