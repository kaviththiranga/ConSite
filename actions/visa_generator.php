<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {

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


    echo($fullName);


}
