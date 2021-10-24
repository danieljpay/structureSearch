<?php
include("databaseFunctions.php");
include("InvertedIndex/InvertedIndex.php");
$file = fopen($_FILES['inputFile']['tmp_name'], "r") or die("problemas al abrir el archivo");
$fileContent = '';
while (!feof($file)) {
    $fileContent .= fgets($file);
}

// LA FUNCION getDocContent DEVOLVERA EL CONTENIDO DEL DOCUMENTO CON EL ID PROPORCIONADO
// echo getDocContent(4);


// LA FUNCION genNewID DEVOLVERA EL ID DISPONIBLE PARA EL NUEVO DOCUMENTO
//$newID = genNewID();
newFile($fileContent);

// LA FUNCION getAllDocs DEVOLVERA UN ARRAY CON EL ID Y CONTENIDO DE TODOS LOS DOCUMENTOS ALMACENADOS
// EL ARRAY TIENE LA ESTRUCTURA CLAVE(ID) => VALOR(CONTENIDO)
// SE DEJA UN EJEMPLO DE COMO ACCEDER AL CONTENIDO DEL DOCUMENTO 3
// $allDocs = getAllDocs ();
// echo $allDocs[3];

// LA FUNCION getDocumentsWith DEVOLVERA UN ARRAY CON EL ID DE LOS
// DOCUMENTOS QUE CONTENGAN LA PALABRA PROPORCIONADA
// var_dump(getDocumentsWith("palabra1"));

//downloadDocument(1, __DIR__ . "\\");
//wnloadDocument(4);


//------------------------------------- FUNCIONES QUE SIRVEN

//CAMBIAR A ID AUTOINCREMENTABLE
function newFile($content)
{
    //$keywords = readKeywords($content);
    //$uniqueKeywords = array_unique($keywords);
    //$invertInd = new InvertedIndex();
    //$data = $invertInd->startInvertedIndex($content, $ID);
    
    insertFile($content);
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
