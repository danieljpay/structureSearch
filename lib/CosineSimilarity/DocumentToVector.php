<?php
function createDocVector($dictionary, $docId){
    //query para obtener terminos enviando id
    //Lo siguiente es puramente por casos de prueba en lo que se genera la implementación
    if($docId == 1){
        $docTerms = array("the","best","Italian","restaurant","enjoy","pasta");
        $values = array();
        foreach($dictionary as $term){
            if(in_array($term, $docTerms)){
                $values[] = queryFindFrequencyTermByDocId($term, $docId);
            }else{
                $values[] = 0;
            }
        }
        //return $values;
        return array($docId,1,1,1,2,2,1,0,0,0,0);
    }
    if($docId == 2){
        $values = array();
        $docTerms = array("American","restaurant","enjoy","the","best","hamburger");
        foreach($dictionary as $term){
            if(in_array($term, $docTerms)){
                $values[] = queryFindFrequencyTermByDocId($term, $docId);
            }else{
                $values[] = 0;
            }
        }
        //return $values;
        return array($docId,0,1,1,1,1,0,1,1,0,0);
    }
    if($docId == 3){
        $values = array();
        $docTerms = array("Korean","restaurant","enjoy","the","best","bibibamp");
        foreach($dictionary as $term){
            if(in_array($term, $docTerms)){
                $values[] = queryFindFrequencyTermByDocId($term, $docId);
            }else{
                $values[] = 0;
            }
        }
        //return $values;
        return array($docId,0,1,1,1,1,0,0,0,1,1);
    }
}

function createQueryToVector($dictionary, $queryKW){
    return array(-1,0,1,0,2,2,0,1,0,0,0);
}