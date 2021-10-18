<?php
function getDocsId(){
    $documents = array();
    $documents[] = 1;//"the best Italian restaurant enjoy the best pasta"; 
    $documents[] = 2;//"American restaurant enjoy the best hamburger";
    $documents[] = 3;//"Korean restaurant enjoy the best bibimbap";
    return $documents;
}

function queryFindTermsById($docsId){
    //Implementacion de armar una query que devuelva un array de terminos de acuerdo a la lista de id's
    $docTerms = array();
    return $docTerms;
}

function queryFindFrequencyTermByDocId($term, $docId){
    //Implement
}

function getTermsByDocsQuery($docsTerms, $queryTerms){
    //Implementación para generar un único array que no tenga los términos repetidos
    return array("Italian", "restaurant", "enjoy", "the", "best", "pasta", "American", "hamburger", "Korean", "bibimbap");
}