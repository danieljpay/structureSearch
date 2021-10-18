<?php
function createDocVector($dictionary, $docId)
{
    //query para obtener terminos enviando id
    //Lo siguiente es puramente por casos de prueba en lo que se genera la implementación
    if ($docId == 1) {
        $docTerms = array("the", "best", "Italian", "restaurant", "enjoy", "the", "best", "pasta");
        $values = array();
        $values[] = $docId;
        foreach ($dictionary as $term) {
            if (in_array($term, $docTerms)) {
                $values[] = (array_count_values($docTerms)[$term]) / sizeof($docTerms); //queryFindFrequencyTermByDocId($term, $docId);//Hay que calcular la longitud real de No de
                //terminos en el documento para dividir el resultado
            } else {
                $values[] = 0;
            }
        }
        //return $values;
        //return array($docId,1,1,1,2,2,1,0,0,0,0); // sin refinamiento 
        return $values; //array($docId,1/8,1/8,1/8,2/8,2/8,1/8,0,0,0,0); // ya refinado
    }
    if ($docId == 2) {
        $values = array();
        $docTerms = array("American", "restaurant", "enjoy", "the", "best", "hamburger");
        $values[] = $docId;
        foreach ($dictionary as $term) {
            if (in_array($term, $docTerms)) {
                $values[] = (array_count_values($docTerms)[$term]) / sizeof($docTerms); //queryFindFrequencyTermByDocId($term, $docId);
            } else {
                $values[] = 0;
            }
        }
        //return $values;
        //return array($docId,0,1,1,1,1,0,1,1,0,0); //sin refinamiento 
        return $values; //array($docId,0,1/6,1/6,1/6,1/6,0,1/6,1/6,0,0);
    }
    if ($docId == 3) {
        $values = array();
        $docTerms = array("Korean", "restaurant", "enjoy", "the", "best", "bibimbap");
        $values[] = $docId;
        foreach ($dictionary as $term) {
            if (in_array($term, $docTerms)) {
                $values[] = (array_count_values($docTerms)[$term]) / sizeof($docTerms); //queryFindFrequencyTermByDocId($term, $docId);
            } else {
                $values[] = 0;
            }
        }
        //return $values;
        //return array($docId,0,1,1,1,1,0,0,0,1,1);
        return $values; //array($docId,0,1/6,1/6,1/6,1/6,0,0,0,1/6,1/6);
    }
}

function createQueryToVector($dictionary, $queryKW)
{
    $values = array();
    $docTerms = array("the", "best", "the", "best", "American", "restaurant");
    $values[] = -1;
    foreach ($dictionary as $term) {
        if (in_array($term, $docTerms)) {
            $values[] = (array_count_values($docTerms)[$term]) / sizeof($docTerms); //queryFindFrequencyTermByDocId($term, $docId);
        } else {
            $values[] = 0;
        }
    }
    //return $values;
    //return array($docId,0,1,1,1,1,0,0,0,1,1);
    return $values; //array($docId,0,1/6,1/6,1/6,1/6,0,0,0,1/6,1/6);
}
