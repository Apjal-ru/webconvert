<?php

function convertVideoToFormat($inputVideo, $outputFile, $outputFormat) {
    $ffmpegPath = 'ffmpeg';
    $inputVideo = escapeshellarg($inputVideo);
    $outputFile = escapeshellarg($outputFile);
    $outputFormat = escapeshellarg($outputFormat);
    $outputFile .= './hasil/' . $outputFormat;

    $command = "$ffmpegPath -i $inputVideo -q:a 0 -map a $outputFile";
    exec($command, $output, $returnCode);

    if ($returnCode !== 0) {
        // Tampilkan pesan kesalahan
        echo implode("\n", $output);
    }

    return $returnCode === 0;
}


?>
