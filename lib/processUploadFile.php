<?php
    include("databaseFunctions.php");

    $file = fopen($_FILES['inputFile']['tmp_name'], "r") or die("problemas al abrir el archivo");
    $fileContent = '';
    while(!feof($file)) {
        $fileContent .= fgets($file);
    }
    
     //insertFile($fileContent);

    // echo getDocContent(4);
    
    //var_dump( newKeyword("Palabra prueba",3,5,"3,5,7,11"));

    //newFile(9,$fileContent);
    downloadDocument(4);
    //------------------------------------- FUNCIONES QUE SIRVEN

    function newFile ($ID,$content) {
        $keywords = readKeywords($content);
        $uniqueKeywords = array_unique($keywords);
        if (insertFile($ID,$content)) {
            uploadAllWords ($uniqueKeywords,$ID);
        }

    }

    function readKeywords ($content) {
        $garbage = array("\n", ". ", "." ,", ", "; ", ' "', '" ');
        $adjustedContent = str_replace($garbage," ",$content);
        return explode(" ",$adjustedContent);
    }

    function uploadAllWords ($keywords,$ID) {
        foreach ($keywords as $keyword) {
            newKeyword($keyword,$ID,3,"3,5,7");
        }
    }

?>