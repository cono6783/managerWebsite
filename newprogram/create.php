<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

var_dump($_POST);
var_dump($_FILES);
phpinfo();

$name = $_POST["name"];
$fileType = strtolower(pathinfo(basename($_FILES["workingdirzip"]["name"]),PATHINFO_EXTENSION));
$workingdir = "/var/projects/$name/";
$startcmd = $_POST["startcmd"];
$uploadOk = 1;



//Check project existence
if (is_dir("/var/projects/$name")) {
    echo "A project with that name already exists";
    $uploadOk = 0;
}

if ($fileType != "zip") {
    echo "working dir zip must be a zip file";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Project not created";
} else {
    var_dump($_FILES);
    if (move_uploaded_file($_FILES["workingdirzip"]["tmp_name"], "/var/projects/$name.zip")) {
        echo shell_exec("unzip /var/projects/$name.zip -d /var/projects/$name/");
        echo shell_exec("./createservice.sh '$name' '$startcmd' '/var/projects/$name', jhub");
    } else {
        echo "File did not upload";
    }
}



?>