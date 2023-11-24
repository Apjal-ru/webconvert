<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video to Audio Converter</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Video to Audio Converter</h1>

        <form id="convertForm" action="convert.php" method="post" enctype="multipart/form-data">
            <label for="videoFile">Choose Video File:</label>
            <input type="file" name="videoFile" accept="video/*" required>
            <br>
            <label for="audioFormat">Select Audio Format:</label>
            <select name="audioFormat">
                <option value="mp3">MP3</option>
                <option value="ogg">OGG</option>
                <option value="wav">WAV</option>
            </select>
            <br>
            <input type="button" value="Convert" onclick="convertVideo()">
        </form>

        <div id="progressContainer" style="display: none;">
            <p id="progressLabel">Converting...</p>
            <progress id="conversionProgress" max="100" value="0"></progress>
            <a id="downloadButton" href="#" download style="display: none;">Download Audio</a>
        </div>
    </div>

    <script>
    function convertVideo() {
        var form = document.getElementById('convertForm');
        var formData = new FormData(form);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', form.action, true);

        xhr.upload.onprogress = function (e) {
            if (e.lengthComputable) {
                var percentComplete = (e.loaded / e.total) * 100;
                document.getElementById('conversionProgress').value = percentComplete;
            }
        };

        xhr.onload = function () {
            if (xhr.status === 200) {
                document.getElementById('progressContainer').style.display = 'block';
                document.getElementById('progressLabel').innerText = 'Conversion Complete';
                document.getElementById('downloadButton').style.display = 'block';

                // Menghasilkan tautan download dengan menambahkan attribute "download"
                var downloadLink = document.getElementById('downloadButton');
                downloadLink.href = 'download.php?format=' + formData.get('audioFormat');
                downloadLink.setAttribute('download', 'hasil.' + formData.get('audioFormat'));

            } else {
                alert('Error during conversion. Please try again.');
            }
        };

        xhr.send(formData);
    }
</script>

</body>
</html>
