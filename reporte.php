<?php
require("fpdf.php");
class PDF extends FPDF{
    //cabecera de pagina
    function Header(){
        //logo
        $this->Cell(-200);
        $this->SetY(0);
        $this->SetFont('arial','B',10);
        $this->SetTextColor(255,255,255);
        $this->SetX(90);
        $this->Write(10,'Deitoon');
        $this->Cell(-200);
        $this->Ln(10);
    }
    function Footer(){
        $this->SetFillColor(20.05,19);
        $this->Rect(0,270,220,20,'F');
        $this->SetY(-20);
        $this->SetFont('Arial','',10);
        $this->SetTextColor(255,255,255);
        $this->SetX(90);
        $this->Write(10,'Deitoon');
        $this->Ln();
    }
}
    $pdf = new PDF();
    $pdf ->AliasNbPages();
    $pdf ->AddPage();
    $pdf ->SetFont('Arial','',10);

    $pdf ->SetY(50);
    $pdf ->SetX(10);
    $pdf ->SetTextColor(255,255,255);
    $pdf ->SetFillColor(79,59,120);
    $pdf ->Cell(49,9,'Cod. Articulo',0,0,'C',1);
    $pdf ->Cell(49,9,'Producto',0,0,'C',1);
    $pdf ->Cell(49,9,'Descripcion',0,0,'C',1);
    $pdf ->Cell(49,9,'Cant_existencia',0,1,'C',1);
    include ("db.php");
    require ("db.php");

    $consulta = "SELECT * FROM `tab_artículos`";
    $resultado = mysqli_query($conexion, $consulta);

    $pdf->SetTextColor(0,0,0);
    $pdf->SetFillColor(240,240,240);
    while($row = $resultado->fetch_assoc()){
        $pdf->SetX(10);
        $pdf->Cell(49,9,$row['cod_articulo'],0,0,'C',1);
        $pdf ->Cell(49,9,$row['producto'],0,0,'C',1);
        $pdf ->Cell(49,9,$row['descripcion'],0,0,'C',1);
        $pdf ->Cell(49,9,$row['cant_existencia'],0,1,'C',1);
    }
    $pdf->Output();
?>