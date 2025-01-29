<!DOCTYPE html>
<html lang="en">
<head>
    <title>Form</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
<form action="upload.php" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input class="submit" type="submit" value="UploadImage" name="submit">
</form>

</body>
</html>