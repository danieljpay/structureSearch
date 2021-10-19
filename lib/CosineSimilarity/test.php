<?php
function getDocsId($docs){
    $documents = array();
    foreach($docs as $doc){
        if(!(in_array($doc['Document_ID'], $documents))){
            $documents[] = $doc['Document_ID'];
        }
    }
    return $documents;
}

function queryFindTermsById($docsId){
    
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