<?php


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



    echo($firstName);


}
