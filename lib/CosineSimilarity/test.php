<?php
function getDocsId($docs){
    $documents = array();
    foreach($docs as $doc){
        $documents[] = $doc['Document_ID'];
    }
    return $documents;
}

function queryFindTermsById($docsId){
    //Implementacion de armar una query que devuelva un array de terminos de acuerdo a la lista de id's
    $docTerms = array();
    return $docTerms;
}

function queryFindFrequencyTermByDocId($term, $docId){
    //Implement
    return 1; // implementar query
}

function getTermsByDocsQuery($docsTerms, $queryTerms){
    //Implementación para generar un único array que no tenga los términos repetidos
    return array("Italian", "restaurant", "enjoy", "the", "best", "pasta", "American", "hamburger", "Korean", "bibimbap");
}