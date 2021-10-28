<?php
include("databaseFunctions.php");
$file = fopen($_FILES['inputFile']['tmp_name'], "r") or die("problemas al abrir el archivo");
$fileContent = '';
while (!feof($file)) {
    $fileContent .= fgets($file);
}

insertFile($fileContent);
