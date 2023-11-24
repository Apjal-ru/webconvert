<?php
include('converter_functions.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["videoFile"])) {
    $inputVideo = $_FILES["videoFile"]["tmp_name"];
    $outputFile = 'hasil';

    if (convertToMP3($inputVideo, $outputFile)) {
        echo "Conversion to MP3 successful!";
    } else {
        echo "Conversion to MP3 failed.";
    }
}
?>
