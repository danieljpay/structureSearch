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

<<<<<<< HEAD
    newFile(3,$fileContent);
    
    
=======
    //newFile(9,$fileContent);
    downloadDocument(6);
    downloadDocument(8);

>>>>>>> 2d23c5d1653ab318bba14d49bed38632428917a2
    //------------------------------------- FUNCIONES QUE SIRVEN
    
    //CAMBIAR A ID AUTOINCREMENTABLE
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