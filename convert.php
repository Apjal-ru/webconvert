<?php
include('converter_functions.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["videoFile"])) {
    $inputVideo = $_FILES["videoFile"]["tmp_name"];
    $outputFormat = isset($_POST["audioFormat"]) ? $_POST["audioFormat"] : 'mp3';

    switch ($outputFormat) {
        case 'mp3':
        case 'ogg':
        case 'wav':
            $outputFile = 'hasil.' . $outputFormat;
            break;

        default:
            echo "Invalid audio format.";
            exit;
    }

    if (convertVideoToFormat($inputVideo, $outputFile, $outputFormat)) {
        http_response_code(200); // OK
    } else {
        http_response_code(500); // Internal Server Error
    }
}
?>
