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
    $this->Cell(95,10,'LISTADO DE EXAMEN DEL PACIENTE',1,0,'C');
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

$orden1="SELECT p.dpi_pa AS dpi_pa, p.nom_pa AS nom_pa,`dire_pa`,`tele_pa`,`sexo_pa`,`fecna_pa` 
FROM sol AS s 
INNER JOIN paciente AS p ON s.fk_pac=p.id_pa
 WHERE s.id_sol=".$v1;
$paquete1=mysqli_query($conection,$orden1);
$reg1=mysqli_fetch_array($paquete1);

$result = mysqli_query($conection, "SELECT ex.nombre AS nombre_ex, de.resultado_ex AS resultado_ex,CONVERT(de.fecha_ex,DATE) AS fecha FROM tbl_serv as t INNER JOIN sol AS s ON t.fk_sol=s.id_sol 
    INNER JOIN paciente AS p ON s.fk_pac=p.id_pa 
    INNER JOIN detalle_ex AS de ON t.fkdetaex=de.iddetaex 
    INNER JOIN examenes AS ex ON de.fk_exa=ex.idexa 
    WHERE t.fk_sol=".$v1) or die("database error:". mysqli_error($conection));
 
$pdf = new PDF('P','mm','Letter');
$pdf->setTitle("Reporte");
//header
$pdf->AddPage();
//foter page
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',12);
$texto1="DPI: ".$reg1[0]."\nNombre: ".$reg1[1]."\nDireccion: ".$reg1[2]."\nTelefono: ".$reg1[3]."\nSexo: ".$reg1[4]."\nFecha Nacimiento: ".$reg1[5];
$pdf->SetXY(20, 40);
$pdf->MultiCell(90,10,$texto1,0,"L");

$pdf->SetFont('Arial','B',12);
// Declaramos el ancho de las columnas
$w = array(70, 100, 25);
//Declaramos el encabezado de la tabla
$pdf->SetFillColor(2,157,116);
$pdf->SetTextColor(240, 255, 240);
$pdf->Cell(70,12,'TIPO DE EXAMEN',1,0,'C',TRUE);
$pdf->Cell(100,12,'RESULTADO',1,0,'C',TRUE);
$pdf->Cell(25,12,'FECHA',1,0,'C',TRUE);

$pdf->Ln();
$pdf->SetFont('Arial','',12);
$pdf->SetTextColor(0,0,0);
//Mostramos el contenido de la tabla
  while($row =mysqli_fetch_array($result))
    {
       
        $pdf->Cell($w[0],6,$row['nombre_ex'],1,0,'C');
        $pdf->Cell($w[1],6,$row['resultado_ex'],1,0,'C');
        $pdf->Cell($w[2],6,$row['fecha'],1,0,'C');
        $pdf->Ln();
    }
$pdf->Output();
?>
