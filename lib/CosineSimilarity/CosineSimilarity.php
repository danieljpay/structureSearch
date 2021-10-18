<?php
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

