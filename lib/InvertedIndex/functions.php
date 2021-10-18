<?php

function listdocuments($content)
{
    $documentslist = array();    
    $documentslist[] = $content;

    return $documentslist;
}

function generatorDocuments($documentslist, $id)
{
    $documents = $documentslist;
    $documents_array = array();

    for ($j = 0; $j < count($documents); $j++) {
        $Document = removeCharacters($documents[$j]);
        $array_terms = generatorTerms($Document);
        $documents_array[] = new Documento($id,$array_terms);
    }
    return $documents_array;
}

function generatorTerms($document)
{
    $format_string = trim($document);
    $claves = preg_split("/[\s]+/", $format_string);
    //$breakSpace = explode(" ", $document);
    return $claves;
}

//Remueve los caracteres especiales definidos por nosotros , . o ; 
function removeCharacters($document)
{
    $result = str_replace(array("", ",", ".", ";", "\n"), ' ', $document);
    return $result;
}
