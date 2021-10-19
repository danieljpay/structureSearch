<?php
function getAllTerms($objectDocuments, $vocabulary)
{
    for ($i = 0; $i < sizeof($objectDocuments); $i++) {
        $vocabulary = getTermsDTO($objectDocuments[$i][1], $vocabulary);
    }
    return $vocabulary;
}

function getTermsDTO($dtoTermsDocument, $vocabulary)
{
    foreach ($dtoTermsDocument as $term) {
        if (!(in_array($term, $vocabulary))) {
            $vocabulary[] = $term;
        }
    }
    return $vocabulary;
}

function createDocVector($dictionary, $dtoDoc){
    $values = array();
    $values[] = $dtoDoc[0];
    foreach ($dictionary as $term) {
        if (in_array($term, $dtoDoc[1])) {
            $values[] = (array_count_values($dtoDoc[1])[$term]) / sizeof($dtoDoc[1]);
        } else {
            $values[] = 0;
        }
    }
    return $values;
}

function createQueryToVector($dictionary, $queryKW, $queryFreq)
{
    $values = array();
    $values[] = -1;
    $size = 0;
    foreach($queryFreq as $freq){
        $size += $freq;
    }
    foreach ($dictionary as $term) {
        if (in_array($term, $queryKW)) {
            $values[] = $queryFreq[(array_search($term, $queryKW))] / $size;
        } else {
            $values[] = 0;
        }
    }
    return $values; 
}
