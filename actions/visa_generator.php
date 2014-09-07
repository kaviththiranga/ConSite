<?php

$html2pdfClassPath = dirname(__FILE__).'/../includes/html2pdf.class.php';
$visaLetterTemplate = dirname(__FILE__)."/../templates/letter.html";

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

    // Fetch template content
    $content = file_get_contents($visaLetterTemplate);

    // Replace placeholder values
    $content = str_replace("XX_DATE_XX", date("d-m-Y"), $content);
    $content = str_replace("XX_FULL_NAME_XX", $fullName, $content);
    $content = str_replace("XX_PASSPORT_NUM_XX", $passportNumber, $content);
    $content = str_replace("XX_ORG_NAME_XX", $organizationName, $content);

    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'en'); // settings
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('visa_letter_'.$passportNumber.'.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }


}
?>