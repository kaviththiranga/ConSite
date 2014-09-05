<?php

$html2pdfClassPath = dirname(__FILE__).'/../includes/html2pdf.class.php';
$visaLetterTemplate = dirname(__FILE__)."/../templates/invoice.html";

require_once($html2pdfClassPath);

if (isset($_POST['download_visa']) && isset($_POST['download_visa']) == "download") {

    // fetching post parameters
    $fullName = $_POST["fullName"];
    $passportNumber = $_POST["passportNumber"];

    $issuedDate_Day = $_POST["issuedDate_Day"];
    $issuedDate_Month = $_POST["issuedDate_Month"];
    $issuedDate_Year = $_POST["issuedDate_Year"];

    $expireDate_Day = $_POST["expireDate_Day"];
    $expireDate_Month = $_POST["expireDate_Month"];
    $expireDate_Year = $_POST["expireDate_Year"];

    $placeOfIssue = $_POST["placeOfIssue"];
    $organizationName = $_POST["organizationName"];

    $content = file_get_contents($visaLetterTemplate);
    //echo($content);

    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'en');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('exemple10.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }


}
?>