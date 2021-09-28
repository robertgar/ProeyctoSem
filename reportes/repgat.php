<?php
//Incluimos el fichero de conexion
include_once($_SERVER['DOCUMENT_ROOT'] .'/Proyectop/procesos/conexion.php');
//Incluimos la libreria PDF
include_once($_SERVER['DOCUMENT_ROOT'] .'/Proyectop/libs/fpdf.php');
 $v1=$_GET['id'];
class PDF extends FPDF
{
// Funcion encargado de realizar el encabezado
function Header()
{
    // Logo
$this->Image($_SERVER['DOCUMENT_ROOT'] .'/Proyectop/imgenes/asilo.jpg',10,5,25,25);

    $this->SetFont('Arial','B',13);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(105,10,'LISTADO DEL MES',1,0,'C');
    // Line break
    $this->Ln(20);
}
// Funcion pie de pagina
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
}
}


$result = mysqli_query($conection, "SELECT p.nom_tipo AS nombre, s.monto AS monto, s.fecha_pago AS pago FROM detalle_gasto AS s
INNER JOIN tipogasto  AS p ON s.fk_tgasto=p.id
WHERE s.mes=".$v1) or die("database error:". mysqli_error($conection));
 

$pdf = new PDF('P','mm','Letter');
$pdf->setTitle("Reporte");
//header
$pdf->AddPage();
//foter page
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',12);

// Declaramos el ancho de las columnas
$w = array(70, 70,50);
//Declaramos el encabezado de la tabla
$pdf->SetFillColor(2,157,116);
$pdf->SetTextColor(240, 255, 240);
$pdf->Cell(70,12,'TIPO DE PAGO',1,0,'C',true);
$pdf->Cell(70,12,'MONTO',1,0,'C',true);
$pdf->Cell(50,12,'FECHA PAGO',1,0,'C',true);
$pdf->Ln();
$pdf->SetFont('Arial','',12);
$pdf->SetTextColor(0,0,0);
//Mostramos el contenido de la tabla

 while($row =mysqli_fetch_array($result))
    {
        $pdf->Cell($w[0],6,$row['nombre'],1,0,'C');
        $pdf->Cell($w[1],6,$row['monto'],1,0,'C');
        $pdf->Cell($w[2],6,$row['pago'],1,0,'C');

        $pdf->Ln();
    }





$pdf->Output('P001','I');
?>
