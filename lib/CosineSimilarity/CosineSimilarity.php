<?php
function cosineSimilarity($query, $document){
    $product = scalarProduct($query, $document);
    $moduleQuery = vectorModule($query);
    $moduleDocument = vectorModule($document);
    return $product/($moduleQuery*$moduleDocument);
}

function scalarProduct($query, $document){
    $scalar = 0;
    for($i=1; $i<sizeof($query); $i++){
        $scalar += ($query[$i]*$document[$i]);
    }
    return $scalar;
}

function vectorModule($vector){
    $module = 0;
    for($i=1; $i<sizeof($vector); $i++){
        $module += pow($vector[$i], 2);
    }
    return sqrt($module);
}

function termWeights($query, $documentList){

}

function idf(){
    //LaTeX: {idf}_t = log_{10}\frac{N}{{df}_{t}}
    //log10(2.7183)
}

