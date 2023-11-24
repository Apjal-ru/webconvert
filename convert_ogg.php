<?php
include('converter_functions.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["videoFile"])) {
    $inputVideo = $_FILES["videoFile"]["tmp_name"];
    $outputFile = 'hasil';

    if (convertToOGG($inputVideo, $outputFile)) {
        echo "Conversion to OGG successful!";
    } else {
        echo "Conversion to OGG failed.";
    }
}
?>
