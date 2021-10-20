<?php
include("test.php");
include("DocumentToVector.php");
include("CosineSimilarity.php");
include("functionsCos.php");
function startCosineSimilarity($dto)
{
    //dto[0] = la informacion de los documentos
    //dto[1] = terminos de la query
    //dto[2] = frecuencia de los terminos de la query
    $queryKW = $dto[1];
    $docsId = getDocsId($dto[0]);
    $objectDocuments = array();
    foreach ($docsId as $id) {
        $array = array();
        $array[] = $id;
        $array[] = generatorTerms(strtoupper(removeCharacters(getDocContent($id))));
        $objectDocuments[] = $array;
    }
    $dictionary = getAllTerms($objectDocuments,array());
    $docsTerms = array();
    foreach($objectDocuments as $dtoDoc){
        $docsTerms[] = $dtoDoc[1];
    }
    $docsTerms[] = $queryKW;
    $idf = idf($dictionary, $docsTerms);

    $arrayDocs = array();
    foreach($objectDocuments as $dtoDoc){
        $arrayDocs[] = createDocVector($dictionary, $dtoDoc);
    }
    $arrayDocs[] = createQueryToVector($dictionary, $queryKW, $dto[2]);

    $tf_idf = array();
    foreach ($arrayDocs as $doc) {
        $objectData = array();
        $objectData[] = $doc[0];
        foreach ($idf as $index => $coefficient) {
            $objectData[] =  $doc[$index + 1] * $coefficient;
        }
        $tf_idf[] = $objectData;
    }
    $vectorSize = sizeof($tf_idf);
    $cosineValues = array();
    for ($i = 0; $i < $vectorSize; $i++) {
        $cosineValues[] = cosineSimilarity($tf_idf[$vectorSize - 1], $tf_idf[$i]);
    }

    $results = array();
    foreach($cosineValues as $index => $value){
        $dtoResult = array();
        $dtoResult[] = $arrayDocs[$index][0];
        $dtoResult[] = $value;
        $results[] = $dtoResult;
    }
    $resultsSort =  burbuja($results);
    printResults($resultsSort);
    //$idf = idf();
    //var_dump($vocabulary);

    //$docTermsList[] = queryFindTermsById($docsId);
    //printResults($dto[0]);
}

function burbuja($results)
{
    $longitud = count($results);
    for ($i = 0; $i < $longitud-1; $i++) {
        for ($j = 0; $j < $longitud - 2; $j++) {
            if ($results[$j][1] < $results[$j + 1][1]) {
                $temporal = $results[$j];
                $results[$j] = $results[$j + 1];
                $results[$j + 1] = $temporal;
            }
        }
    }
    $array = array();
    for ($i = 0; $i < sizeof($results)-1; $i++) {
        $array[] = $results[$i];
    }
    return $array;
}