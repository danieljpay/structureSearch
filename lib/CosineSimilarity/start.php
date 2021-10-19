<?php
include("test.php");
include("DocumentToVector.php");
include("CosineSimilarity.php");
function startCosineSimilarity($dto)
{
    //dto[0] = la informacion de los documentos
    //dto[1] = terminos de la query
    //dto[2] = frecuencia de los terminos de la query
    
    var_dump($dto);
    //printResults($dto[0]);

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