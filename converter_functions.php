<?php

function convertVideoToFormat($inputVideo, $outputFile, $outputFormat) {
    $ffmpegPath = 'ffmpeg';
    $command = "$ffmpegPath -i $inputVideo -q:a 0 -map a $outputFile";
    exec($command, $output, $returnCode);
    return $returnCode === 0;
}

?>
