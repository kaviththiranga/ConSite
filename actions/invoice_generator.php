<?php

$html2pdfClassPath = dirname(__FILE__).'/../includes/html2pdf.class.php';
$invoiceTemplate = dirname(__FILE__)."/../templates/invoice.html";

require_once($html2pdfClassPath);

if (isset($_POST['download_invoice']) && isset($_POST['download_invoice']) == "download") {

    // fetching post parameters

    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $company = $_POST["company"];
    $jobTitle = $_POST["jobTitle"];
    $addrLineOne = $_POST["addrLineOne"];
    $addrLineTwo = $_POST["addrLineTwo"];
    $country = $_POST["country"];
    $state = $_POST["state"];
    $city = $_POST["city"];
    $pONo = $_POST["pONo"];

    // Fetch template content
    $content = file_get_contents($invoiceTemplate);

    // Get other information for invoice
    $invoiceNumber = "1000ABA12";
    $invoiceDate = date("d-m-Y");
    $nameInFull = $firstName.' '.$lastName;
    $total = 0;
    $addressFull = $addrLineOne.'<br>'.$addrLineTwo.'<br>'.$city.', '.$state.'<br>'.$country;

    // item details
    $itemDetails = array();
    $itemPrices = array();

    $itemDetails[0] = "01 Participant for 2 days Conference 1 day tutorial";
    $itemPrices[0] = 10000;

    $itemDetails[1] = "02 Participants for 2 days Conference";
    $itemPrices[1] = 10000;

    // construct columns of item table in invoice
    $itemsColumn = "";
    $pricesColumn = "";

    foreach($itemDetails as $item){

        $itemsColumn = $itemsColumn.$item.'<br>';
    }

    foreach($itemPrices as $itemPrice){

        $pricesColumn = $pricesColumn.$itemPrice.'<br>';
        $total = $total + $itemPrice;
    }

    // Replace placeholder values
    $content = str_replace("XX_INVOICE_NO_XX", $invoiceNumber , $content);
    $content = str_replace("XX_INVOICE_DATE_XX", $invoiceDate , $content);
    $content = str_replace("XX_PO_NO_XX", $pONo , $content);

    $content = str_replace("XX_NAME_XX", $nameInFull , $content);
    $content = str_replace("XX_JOB_TITLE", $jobTitle, $content);
    $content = str_replace("XX_COMPANY_XX", $company, $content);
    $content = str_replace("XX_EMAIL_XX", $email , $content);
    $content = str_replace("XX_PHONE_XX", $phone , $content);
    $content = str_replace("XX_ADDRESS_XX", $addressFull, $content);

    $content = str_replace("XX_ITEMS_COLUMN_XX", $itemsColumn , $content);
    $content = str_replace("XX_ITEM_PRICES_COLUMN_XX", $pricesColumn , $content);
    $content = str_replace("XX_TOTAL_XX", $total , $content);

    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'en'); // settings
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('invoice_'.$email.'.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }

}
