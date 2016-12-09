<?php
$imageFileType = pathinfo(basename($_FILES["file"]["name"]),PATHINFO_EXTENSION);
$sourcePath = $_FILES['file']['tmp_name'];       // Storing source path of the file in a variable
$hashname = md5($_FILES['file']['name'] . microtime());
$targetPath = "../upload/".$hashname.'.'.$imageFileType; // Target path where file is to be stored
move_uploaded_file($sourcePath, $targetPath) ;    // Moving Uploaded file
echo $hashname . '.' . $imageFileType;
