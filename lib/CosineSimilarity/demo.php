<?php
include("test.php");
include("DocumentToVector.php");
include("CosineSimilarity.php");
$query = "the best the best American restaurant";

//Supongamos que se descompone la query correctamente
$queryKW = array("the", "best", "the", "best", "American", "restaurant");

//Vamos a suponer que llamamos la consulta y que me devolvió los  id de los docs correctos. 
$docsId = getDocsId();
$docTermsList[] = queryFindTermsById($docsId);
$dictionary = getTermsByDocsQuery($docTermsList, $queryKW);
$vectors = array();
foreach ($docsId as $docId) {
    $vectors[] = createDocVector($dictionary, $docId);
}
$vectors[] = createQueryToVector($dictionary, $queryKW);
$vectorSize = sizeof($vectors);

$cosineValue = array();
for ($i = 0; $i < $vectorSize - 1; $i++) {
    $cosineValue[] = cosineSimilarity($vectors[$vectorSize - 1], $vectors[$i]);
}
var_dump($cosineValue);
