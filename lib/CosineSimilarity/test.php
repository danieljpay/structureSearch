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