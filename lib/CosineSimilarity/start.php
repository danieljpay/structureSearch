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
    $cosineValue = array();
    for ($i = 0; $i < $vectorSize; $i++) {
        $cosineValue[] = cosineSimilarity($tf_idf[$vectorSize - 1], $tf_idf[$i]);
    }
    echo "<br>";
    var_dump($cosineValue);
    //$idf = idf();
    //var_dump($vocabulary);

    //$docTermsList[] = queryFindTermsById($docsId);
    //printResults($dto[0]);
}

function dummy($dto)
{
    $queryKW = $dto[1];
    $docsId = getDocsId($dto[0]);
    $docTermsList[] = queryFindTermsById($docsId);
    $dictionary = getTermsByDocsQuery($docTermsList, $queryKW);
    $idf = idf($dictionary, array(
        array("the", "best", "Italian", "restaurant", "enjoy", "pasta"),
        array("American", "restaurant", "enjoy", "the", "best", "hamburger"),
        array("Korean", "restaurant", "enjoy", "the", "best", "bibimbap"),
        array("the", "best", "American", "restaurant")
    )); //$docTermsList);

    $vectors = array();
    foreach ($docsId as $docId) {
        $vectors[] = createDocVector($dictionary, $docId);
    }
    var_dump($vectors);
    echo "<br>";
    $vectors[] = createQueryToVector($dictionary, $queryKW);

    $tf_idf = array();
    foreach ($vectors as $vector) {
        $objectData = array();
        foreach ($idf as $index => $coefficient) {
            $objectData[] =  $vector[$index + 1] * $coefficient;
        }
        $tf_idf[] = $objectData;
    }
    //
    echo "<br><br>";
    var_dump($tf_idf);
    echo "<br><br>";

    $vectorSize = sizeof($tf_idf);
    $cosineValue = array();
    for ($i = 0; $i < $vectorSize; $i++) {
        $cosineValue[] = cosineSimilarity($tf_idf[$vectorSize - 1], $tf_idf[$i]);
    }
    echo "<br>";
    var_dump($cosineValue);
}
