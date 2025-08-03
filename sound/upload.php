<?php
ini_set('display_errors',1);
error_reporting(E_ALL);


$target_dir = "/var/shared/sounds/";
$target_file = $target_dir . $_POST["name"];
$uploadOk = 1;
$fileType = strtolower(pathinfo(basename($_FILES["fileToUpload"]["name"]),PATHINFO_EXTENSION));


//Check if file already exists
if (file_exists($target_file)) {
    echo "That sound already exists. Try a different name.";
    $uploadOk = 0;
}

if ($fileType != "mp3") {
    echo "Only mp3s for now. Might set up a conversion system in the future";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "File not uploaded";
} else {
    var_dump($_FILES);
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "File uploaded successfully";
    } else {
        echo "File did not upload";
    }
}
?>
