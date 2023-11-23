<?php

function convertToMP3($inputVideo, $outputFile) {
    $ffmpegPath = 'ffmpeg';
    $command = "$ffmpegPath -i $inputVideo -q:a 0 -map a $outputFile";
    exec($command, $output, $returnCode);
    return $returnCode === 0;
}

function convertToOGG($inputVideo, $outputFile) {
    $ffmpegPath = 'ffmpeg';
    $command = "$ffmpegPath -i $inputVideo -q:a 0 -map a $outputFile";
    exec($command, $output, $returnCode);
    return $returnCode === 0;
}

function convertToWAV($inputVideo, $outputFile) {
    $ffmpegPath = 'ffmpeg';
    $command = "$ffmpegPath -i $inputVideo -q:a 0 -map a $outputFile";
    exec($command, $output, $returnCode);
    return $returnCode === 0;
}

?>
