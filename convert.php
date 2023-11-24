<?php

function convertVideoToFormat($inputVideo, $outputFile, $outputFormat) {
    $ffmpegPath = 'ffmpeg';
    $inputVideo = escapeshellarg($inputVideo);
    $outputFile = escapeshellarg($outputFile);
    $outputFormat = escapeshellarg($outputFormat);
    $outputFile .= '.' . $outputFormat;

    // Pernyataan debug sebelum eksekusi perintah FFmpeg
    echo "Before FFmpeg command\n";

    $command = "$ffmpegPath -i $inputVideo -q:a 0 -map a $outputFile";
    exec($command, $output, $returnCode);

    // Pernyataan debug setelah eksekusi perintah FFmpeg
    echo "After FFmpeg command\n";

    if ($returnCode !== 0) {
        // Tampilkan pesan kesalahan
        echo implode("\n", $output);
    }

    return $returnCode === 0;
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["videoFile"])) {
    $inputVideo = $_FILES["videoFile"]["tmp_name"];
    $outputFormat = isset($_POST["audioFormat"]) ? $_POST["audioFormat"] : 'mp3';

    switch ($outputFormat) {
        case 'mp3':
        case 'ogg':
        case 'wav':
            $outputFile = __DIR__ . './hasil/' . $outputFormat;
            break;

        default:
            echo "Invalid audio format.";
            http_response_code(400);
            exit;
    }

    // Pernyataan debug sebelum eksekusi FFmpeg
    echo "Before FFmpeg\n";

    if (convertVideoToFormat($inputVideo, $outputFile, $outputFormat)) {
        // Set header untuk download file
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($outputFile) . '"');

        // Baca file dan kirim ke output
        readfile($outputFile);

        // Hapus file setelah di-download
        unlink($outputFile);

        // Keluar setelah memberikan respons berhasil
        http_response_code(200);
        exit;
    } else {
        // Ubah HTTP response code ke 500 Internal Server Error
        http_response_code(500);
    }

    // Pernyataan debug setelah eksekusi FFmpeg
    echo "After FFmpeg\n";
}
?>
