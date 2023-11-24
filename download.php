<?php
if ($_GET["format"] && in_array($_GET["format"], ['mp3', 'ogg', 'wav'])) {
    $outputFormat = $_GET["format"];
    $outputFile = 'hasil.' . $outputFormat;

    // Set header untuk download file
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($outputFile) . '"');

    // Baca file dan kirim ke output
    readfile($outputFile);
} else {
    echo "Invalid audio format specified.";
}
?>
