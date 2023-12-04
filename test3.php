<?php
$target_dir = "./uploads/";
$uploadFormat = $_POST["uploadFormat"];
$videoFile = $target_dir . basename($_FILES['videoFile']['name']);

$target_upload = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$filename = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_FILENAME);
$audioFile = $target_dir . pathinfo($videoFile, PATHINFO_FILENAME) . '.' . $audioFormat;
    
// Pindahkan file video yang diunggah ke direktori sementara
if (move_uploaded_file($_FILES['videoFile']['tmp_name'], $target_upload)){
    // Mendapatkan nilai audioFormat dari formulir
    $audioFormat = isset($_POST['audioFormat']) ? $_POST['audioFormat'] : 'mp3';

    // Konversi ke format yang dipilih
    exec("ffmpeg -i $target_upload -q:a 0 -map a $audioFile 2>&1", $output, $returnCode);

    $message = "File berhasil diupload";

    // Tampilkan output dan kode status (hapus ini setelah menemukan masalahnya)
    echo '<pre>';
    print_r($output);
    echo '</pre>';
    echo '<p>Return code: ' . $returnCode . '</p>';

    // Hapus file video yang diunggah
    unlink($target_upload);

    $downloadButton = '<a href="' . $audioFile . '" download>
                        <button style="background-color: #007BFF; color: #fff; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; transition: background-color 0.3s;">
                            Download Hasil Konversi
                        </button>
                    </a>';
} else{
    $message = "Gagal upload file.";
}
?>
