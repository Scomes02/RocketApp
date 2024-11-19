<?php
require('libs/fpdf.php');  // Asegúrate de que tienes FPDF incluido

// Incluir la librería PHP Barcode Generator
require_once '../libs/php-barcode-generator/src/BarcodeGenerator.php';
require_once '../libs/php-barcode-generator/src/BarcodeGeneratorPNG.php';

// Crear el PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Encabezado
$pdf->Cell(0, 10, 'Recibo de Compra', 0, 1, 'C');
$pdf->Ln(10);

// Productos seleccionados (Ejemplo)
$pdf->Cell(0, 10, 'Productos seleccionados:', 0, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(0, 10, "1. Producto A - $100\n2. Producto B - $200\nTotal: $300");
$pdf->Ln(10);

// Método de pago
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Metodo de Pago: Tarjeta de Credito', 0, 1);
$pdf->Ln(10);

// Mensaje de agradecimiento
$pdf->SetFont('Arial', '', 12);
$pdf->MultiCell(0, 10, "Gracias por su compra. Por favor, conserve este recibo para el retiro del local,\n¡Estamos aquí para ayudarte!");
$pdf->Ln(10);

// Generar un código de barras
$codigo = "GRACIAS123456"; // El código que deseas generar

// Crear el generador de código de barras
$generator = new Picqer\Barcode\BarcodeGeneratorPNG();

// Generar el código de barras como imagen PNG
$barcode = $generator->generate($codigo);

// Guardar la imagen del código de barras en un archivo temporal
$barcodeFile = 'libs/barcode.png';
file_put_contents($barcodeFile, $barcode);

// Insertar el código de barras en el PDF
$pdf->Image($barcodeFile, 80, $pdf->GetY(), 50, 20); // Ajusta la posición (x, y) y el tamaño
$pdf->Ln(30);

// Información adicional
$pdf->SetFont('Arial', '', 12);
$pdf->MultiCell(0, 10, "Recuerde llevar este recibo junto con una identificacion oficial para recoger sus productos. Si tiene alguna pregunta, no dude en contactarnos.");
$pdf->Ln(10);

// Salida del PDF
$pdf->Output('recibo.pdf', 'D');

// Eliminar el archivo temporal del código de barras
unlink($barcodeFile);
?>
