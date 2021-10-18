<?php

function listdocuments()
{
    $documentslist = array();
    $Document1 = "Lorem; ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse ut metus. Proin venenatis turpis sit amet ante consequat semper. Aenean nunc. Duis iaculis odio id lectus. Integer dapibus justo vitae elit. Nunc luctus, tortor quis iaculis tempus, urna odio iaculis erat, imperdiet lobortis orci lectus at eros. Ut a velit id odio malesuada nonummy. Aenean cursus metus a purus.";
    
    $documentslist[] = $Document1;

    return $documentslist;
}

function generatorDocuments($documentslist)
{
    $documents = $documentslist;
    $documents_array = array();

    for ($j = 0; $j < count($documents); $j++) {
        $Document = removeCharacters($documents[$j]);
        $array_terms = generatorTerms($Document);
        $documents_array[] = new Documento($j+1,$array_terms);
    }
    return $documents_array;
}

function generatorTerms($document)
{
    $breakSpace = explode(" ", $document);
    return $breakSpace;
}

//Remueve los caracteres especiales definidos por nosotros , . o ; 
function removeCharacters($document)
{
    $result = str_replace(array(",", ".", ";"), '', $document);
    return $result;
}
