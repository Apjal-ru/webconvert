<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["videoFile"])) {
    $inputVideo = $_FILES["videoFile"]["tmp_name"];
    $outputFile = 'output';

    if (convertToOGG($inputVideo, $outputFile)) {
        echo "Konversi video ke OGG berhasil!";
    } else {
        echo "Konversi video ke OGG gagal.";
    }
}

function convertToOGG($inputVideo, $outputFile) {
    $ffmpegPath = 'ffmpeg';
    $command = "$ffmpegPath -i $inputVideo -q:a 0 -map a $outputFile";
    exec($command, $output, $returnCode);
    return $returnCode === 0;
}

?>
