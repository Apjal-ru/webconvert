<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $targetDir = "/var/www/html/webconvert/uploads/";

    // Check if the file was uploaded without errors
    if ($_FILES['videoFile']['error'] !== UPLOAD_ERR_OK) {
        die('File upload failed with error code ' . $_FILES['videoFile']['error'] . ' - ' . $_FILES['videoFile']['error']);
    }

    // Specify the target path for the uploaded file
    $videoFile = $targetDir . basename($_FILES['videoFile']['name']);

    // Move the uploaded file to the specified directory
    if (move_uploaded_file($_FILES['videoFile']['tmp_name'], $videoFile)) {
        // Get the audioFormat value from the form
        $audioFormat = isset($_POST['audioFormat']) ? $_POST['audioFormat'] : 'mp3';

        // Specify the target path for the audio file
        $audioFile = $targetDir . pathinfo($videoFile, PATHINFO_FILENAME) . '.' . $audioFormat;

        // Convert to the selected format using FFmpeg
        exec("ffmpeg -i $videoFile -q:a 0 -map a $audioFile 2>&1", $output, $returnCode);

        // Display output and status code (remove after debugging)
        echo '<pre>';
        print_r($output);
        echo '</pre>';
        echo '<p>Return code: ' . $returnCode . '</p>';

        // Uncomment the following lines if you want to delete the uploaded video file
        //unlink($videoFile);

        // Display link to download the audio file
        echo '<h3>Conversion complete!</h3>';
        echo '<p>Download your audio file:</p>';
        echo '<ul>';
        echo '<li><a href="' . $audioFile . '" download>Download ' . strtoupper($audioFormat) . '</a></li>';
        echo '</ul>';

        // Uncomment the following line if you want to delete the audio file after downloading
        //unlink($audioFile);

    } else {
        die('Failed to move the uploaded file to the target directory. Debug Info: ' . print_r($_FILES, true));
    }

} else {
    // If not a POST method, redirect to the main page
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
</body>
</html>