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
    echo '<pre>';
    print_r($output);
    echo '</pre>';
    echo '<p>Return code: ' . $returnCode . '</p>';

    // Hapus file video yang diunggah
    unlink($videoFile);
    unlink($audioFile);

    // Tampilkan link untuk mengunduh file audio
    echo '<h3>Conversion complete!</h3>';
    echo '<p>Download your audio file:</p>';
    echo '<ul>';
    echo '<li><a href="' . $audioFile . '">Download ' . strtoupper($audioFormat) . '</a></li>';
    echo '</ul>';
} else {
    // Jika bukan metode POST, kembalikan ke halaman utama
    header('Location: index.html');
}
?>
