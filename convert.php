<?php
include('converter_functions.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["videoFile"])) {
    $inputVideo = $_FILES["videoFile"]["tmp_name"];
    $outputFormat = isset($_POST["audioFormat"]) ? $_POST["audioFormat"] : 'mp3';

    switch ($outputFormat) {
        case 'mp3':
            $outputFile = 'output' . $outputFormat;
            break;

        case 'ogg':
            $outputFile = 'output' . $outputFormat;
            break;

        case 'wav':
            $outputFile = 'output' . $outputFormat;
            break;

        default:
            echo "Invalid audio format.";
            exit;
    }

    if (convertVideoToFormat($inputVideo, $outputFile, $outputFormat)) {
        echo "Conversion to $outputFormat successful!";
    } else {
        echo "Conversion to $outputFormat failed.";
    }
}
?>
