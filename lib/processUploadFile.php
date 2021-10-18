<?php
    include("databaseFunctions.php");
    include("InvertedIndex/InvertedIndex.php");
    $file = fopen($_FILES['inputFile']['tmp_name'], "r") or die("problemas al abrir el archivo");
    $fileContent = '';
    while(!feof($file)) {
        $fileContent .= fgets($file);
    }
    
     //insertFile($fileContent);

    // echo getDocContent(4);
    
    //var_dump( newKeyword("Palabra prueba",3,5,"3,5,7,11"));
    //METODO PARA GENERAR ID
    newFile(2,$fileContent);
    //downloadDocument(1);
    //wnloadDocument(4);

    //------------------------------------- FUNCIONES QUE SIRVEN
    
    //CAMBIAR A ID AUTOINCREMENTABLE
    function newFile ($ID,$content) {
        $keywords = readKeywords($content);
        $uniqueKeywords = array_unique($keywords);
        startInvertedIndex($content, $ID);
        var_dump($uniqueKeywords);
        if (insertFile($ID,$content)) {
            uploadAllWords ($uniqueKeywords,$ID);
        }

    }

    function readKeywords ($content) {
        $garbage = array("\n", ". ", "." ,", ", "; ", ' "', '" ');
        $adjustedContent = str_replace($garbage," ",$content);
        $format_string = trim($adjustedContent);
        return preg_split("/[\s]+/", $format_string);
    }

    function uploadAllWords ($keywords,$ID) {
        foreach ($keywords as $keyword) {
            newKeyword($keyword,$ID,3,"3,5,7");
        }
    }
