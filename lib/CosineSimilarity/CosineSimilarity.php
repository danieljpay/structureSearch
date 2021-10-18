<?php
include("test.php");
function cosineSimilarity($query, $document){
    $product = scalarProduct($query, $document);
    $moduleQuery = vectorModule($query);
    $moduleDocument = vectorModule($document);
    return $product/($moduleQuery*$moduleDocument);
}

function scalarProduct($query, $document){
    $scalar = 1;//dummy value
    //to-Do implementation
    return $scalar;
}

function vectorModule($vector){
    $scalar = 1;//dummy value
    //to-Do implementation
    return $scalar;
}

function termWeights($query, $documentList){

}

function idf(){
    //LaTeX: {idf}_t = log_{10}\frac{N}{{df}_{t}}
    //log10(2.7183)
}

