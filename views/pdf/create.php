<?php


$tcpdf_file = "tcpdf/tcpdf.php";
if(isset($_POST["text"]) && isset($tcpdf_file) && $tcpdf_file != "" && file_exists($tcpdf_file)) {
    ob_end_clean();
    include_once $tcpdf_file;

    try {
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT,
        true, 'UTF-8', false);
 
        // dokumentuminformáció beállítása
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Company');
        $pdf->SetTitle('Software info PDF');
        $pdf->SetSubject('Web2');
        $pdf->SetKeywords('TCPDF, PDF, Web2, software');
 
        // margók beállítása
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
 
        $pdf->SetFont('dejavuserif', '', 14);
        $pdf->AddPage();
        $pdf->writeHTML($_POST["text"]);
        $pdf->Output('Szoftver adatok.pdf', 'D');
    }
    catch(Exception $e)
    {
    }
}

