<?php
session_start();
require_once('tcpdf/tcpdf.php');

// Crear el PDF
$pdf = new TCPDF();
$pdf->AddPage();
$pdf->SetFont('helvetica', 'B', 16);

// Encabezado
$pdf->Cell(0, 10, 'Recibo de Compra', 0, 1, 'C');
$pdf->Ln(5);

// Configuración inicial
$pdf->SetFont('helvetica', '', 10);
$pdf->SetDrawColor(0, 0, 0); // Color del borde

// Recuadro dinámico para la sección de productos y total
$startY = $pdf->GetY(); // Posición inicial del rectángulo
$total = 0;
$productDetails = "";

// Generar contenido de productos
if (isset($_SESSION['productos']) && !empty($_SESSION['productos'])) {
    foreach ($_SESSION['productos'] as $producto) {
        $productDetails .= "{$producto['title']} - \$ {$producto['price']} x {$producto['quantity']}\n";
        $total += $producto['price'] * $producto['quantity'];
    }
} else {
    $productDetails = "No hay productos seleccionados.";
}

// Agregar el total al contenido del recuadro
$productDetails .= "\nTotal: \$" . number_format($total, 2);

// Determinar la altura necesaria para el contenido
$productHeight = $pdf->getStringHeight(190, $productDetails);
$pdf->Rect(10, $startY, 190, $productHeight + 10, 'D'); // Altura ajustada al texto
$pdf->MultiCell(0, 10, $productDetails, 0, 'L');
$pdf->Ln(10);

// Método de pago
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, 'Método de Pago: ' . (isset($_GET['metodo']) ? $_GET['metodo'] : 'No especificado'), 0, 1);
$pdf->Ln(5);

// Mensaje de agradecimiento
$pdf->SetFont('helvetica', '', 12);
$pdf->MultiCell(0, 10, "Gracias por su compra. Por favor, conserve este recibo para el retiro del local. ¡Estamos aquí para ayudarte!");
$pdf->Ln(5);

// Información adicional
$pdf->MultiCell(0, 10, "Recuerde llevar este recibo junto con una identificación oficial para recoger sus productos. Si tiene alguna pregunta, no dude en contactarnos.");
$pdf->Ln(10);

// Código de barras
$barcodeText = "442092224992016"; // Código de barras
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 10, 'Código de Barras:', 0, 1, 'L');
$pdf->Ln(5);

// Configuración del estilo del código de barras
$style = array(
    'position' => 'S',
    'align' => 'C',
    'stretch' => false,
    'fitwidth' => true,
    'cellfitalign' => '',
    'border' => false,
    'hpadding' => 0,
    'vpadding' => 0,
    'fgcolor' => array(0, 0, 0),
    'bgcolor' => array(255, 255, 255),
    'text' => true,
    'font' => 'helvetica',
    'fontsize' => 10,
);

// Centrar y dibujar el código de barras
$barcodeWidth = 100; // Ancho del código de barras
$xPosition = ($pdf->getPageWidth() - $barcodeWidth) / 2; // Centrado horizontal
$pdf->write1DBarcode($barcodeText, 'C128', $xPosition, $pdf->GetY(), $barcodeWidth, 18, 0.4, $style, 'N');

// Dibujar el marco exterior ajustado al contenido generado
$pdf->Rect(10, 10, 190, $pdf->GetY() - 10, 'D');

// Salida del PDF
$pdf->Output('recibo.pdf', 'D');
?>
