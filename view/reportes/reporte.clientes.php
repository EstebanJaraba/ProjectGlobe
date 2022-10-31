<?php
require('fpdf.php');

require_once '../http/db/conexion.php';

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    //$this->Image('logo.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(50);
    // Título
    $this->Cell(100,10,'Reporte de clientes',1,0,'C');
    // Salto de línea
    $this->Ln(20);
    //Titulos
    $this->Cell(35,10, utf8_decode('Documento'),1,0,'C',0);
    $this->Cell(35,10, utf8_decode('Nombre'),1,0,'C',0);
    $this->Cell(35,10, utf8_decode('Apellidos'),1,0,'C',0);
    $this->Cell(50,10, utf8_decode('Correo'),1,0,'C',0);
    $this->Cell(35,10, utf8_decode('Teléfono'),1,1,'C',0);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página').$this->PageNo().'/{nb}',0,0,'C');
}
}

$consulta = "SELECT * FROM clients";

$query = mysqli_query($conexion, $consulta);


// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
while ($clientes = $query ->fetch_assoc()) {
    $pdf->Cell(35,10,utf8_decode($clientes['documentClient']),1,0,'C',0);
    $pdf->Cell(35,10,utf8_decode($clientes['nameClient']),1,0,'C',0);
    $pdf->Cell(35,10,utf8_decode($clientes['last_name']),1,0,'C',0);
    $pdf->Cell(50,10,utf8_decode($clientes['email']),1,0,'C',0);
    $pdf->Cell(35,10,utf8_decode($clientes['phone']),1,1,'C',0);

}
$pdf->Output();
?>