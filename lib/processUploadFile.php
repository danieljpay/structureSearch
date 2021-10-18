<?php
include("databaseFunctions.php");
include("InvertedIndex/InvertedIndex.php");
$file = fopen($_FILES['inputFile']['tmp_name'], "r") or die("problemas al abrir el archivo");
$fileContent = '';
while (!feof($file)) {
    $fileContent .= fgets($file);
}

//insertFile($fileContent);

// echo getDocContent(4);

//var_dump( newKeyword("Palabra prueba",3,5,"3,5,7,11"));
//METODO PARA GENERAR ID
newFile(3, $fileContent);
//downloadDocument(1);
//wnloadDocument(4);

//------------------------------------- FUNCIONES QUE SIRVEN

//CAMBIAR A ID AUTOINCREMENTABLE
function newFile($ID, $content)
{
    //$keywords = readKeywords($content);
    //$uniqueKeywords = array_unique($keywords);
    $invertInd = new InvertedIndex();
    $data = $invertInd->startInvertedIndex($content, $ID);
    if (insertFile($ID, $content)) {
        uploadAllWords($invertInd->terms, $data);
    }
}

function readKeywords($content)
{
    $garbage = array("\n", ". ", ".", ", ", "; ", ' "', '" ');
    $adjustedContent = str_replace($garbage, " ", $content);
    $format_string = trim($adjustedContent);
    return preg_split("/[\s]+/", $format_string);
}

function uploadAllWords($keywords, $datas)
{
    foreach ($keywords as $count => $keyword) {
        $dto = $datas[$count]->DTOrow1();
        newKeyword($keyword,$dto[0],$dto[1],$dto[2]);
    }
}
