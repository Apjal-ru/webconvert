<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["videoFile"])) {
    $inputVideo = $_FILES["videoFile"]["tmp_name"];
    $outputFile = 'output';

    if (convertToMP3($inputVideo, $outputFile)) {
        echo "Konversi video ke MP3 berhasil!";
    } else {
        echo "Konversi video ke MP3 gagal.";
    }
}

function convertToMP3($inputVideo, $outputFile) {
    $ffmpegPath = 'ffmpeg';
    $command = "$ffmpegPath -i $inputVideo -q:a 0 -map a $outputFile";
    exec($command, $output, $returnCode);
    return $returnCode === 0;
}

?>
