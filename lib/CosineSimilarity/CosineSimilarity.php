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

function idf($dictionary, $docsTerms){
    //LaTeX: {idf}_t = log_{10}\frac{N}{{df}_{t}}
    $idf = array();
    foreach($dictionary as $term){
        $foundCount = 0;
        foreach($docsTerms as $docTerms){
            if(in_array($term, $docTerms)){
                $foundCount++;
            }
        }
        //echo "El termino " . $term . " aparecio: " . $foundCount . ".";
        if($foundCount != 0){
            $idf[] = log10(sizeof($docsTerms)/$foundCount);
            //echo "Se obtuvo " . log10(sizeof($docsTerms)/$foundCount) . "<br>";
        }else{
            $idf[] = 0;
        }
    }
    return $idf;
}

