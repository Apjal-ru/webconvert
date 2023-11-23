<?php
include('converter_functions.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["videoFile"])) {
    $inputVideo = $_FILES["videoFile"]["tmp_name"];
    $outputFile = 'output';

    if (convertToWAV($inputVideo, $outputFile)) {
        echo "Conversion to WAV successful!";
    } else {
        echo "Conversion to WAV failed.";
    }
}
?>
