<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $targetDir = "./uploads/";
    $videoFile = $targetDir . basename($_FILES['videoFile']['name']);

    // Pindahkan file video yang diunggah ke direktori sementara
    move_uploaded_file($_FILES['videoFile']['tmp_name'], $videoFile);

    // Mendapatkan nilai audioFormat dari formulir
    $audioFormat = isset($_POST['audioFormat']) ? $_POST['audioFormat'] : 'mp3';

    // Konversi ke format yang dipilih
    $audioFile = $targetDir . pathinfo($videoFile, PATHINFO_FILENAME) . '.' . $audioFormat;
    exec("ffmpeg -i /var/www/html/webconvert/uploads/video.mp4 -q:a 0 -map a $audioFile 2>&1", $output, $returnCode);

    // Tampilkan output dan kode status (hapus ini setelah menemukan masalahnya)
    //echo '<pre>';
    //print_r($output);
    //echo '</pre>';
    //echo '<p>Return code: ' . $returnCode . '</p>';

    // Hapus file video yang diunggah
    //unlink($videoFile);

    // Tampilkan link untuk mengunduh file audio
    //echo '<h3>Conversion complete!</h3>';
    //echo '<p>Download your audio file:</p>';
    //echo '<ul>';
    //echo '<li><a href="' . $audioFile . '">Download ' . strtoupper($audioFormat) . '</a></li>';
    //echo '</ul>';

    // Hapus file audio setelah didownload
    //unlink($audioFile);

} else {
    // Jika bukan metode POST, kembalikan ke halaman utama
    header('Location: index.html');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video to Audio Converter</title>
    <link rel="stylesheet" href="web.css">
</head>
<body>
    <h2>Video to Audio Converter</h2>
    <?php
    if (isset($audioFile)) {
        echo '<div class="download-container">';
        echo '<h3>Conversion complete!</h3>';
        echo '<p>Download your audio file:</p>';
        echo '<ul>';
        echo '<li><a class="download-link" href="' . $audioFile . '" download>Download ' . strtoupper($audioFormat) . '</a></li>';
        echo '</ul>';
        echo '</div>';
    }
    ?>
</body>
</html>
