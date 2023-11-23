<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["videoFile"])) {
    $inputVideo = $_FILES["videoFile"]["tmp_name"];
    $outputMP3 = 'output/audio.mp3';

    if (convertVideoToMP3($inputVideo, $outputMP3)) {
        echo "Konversi video ke MP3 berhasil!";
    } else {
        echo "Konversi video ke MP3 gagal.";
    }
}

function convertVideoToMP3($inputVideo, $outputMP3) {
    $ffmpegPath = 'ffmpeg';
    $command = "$ffmpegPath -i $inputVideo -q:a 0 -map a $outputMP3";
    exec($command, $output, $returnCode);

    return $returnCode === 0;
}

?>
