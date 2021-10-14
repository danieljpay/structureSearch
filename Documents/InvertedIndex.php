<?php
include ("Documento.php");
include ("Corpus.php");
include ("DataInvertedIndex.php");
include ("DataOcurrences.php");

$d1 = new Documento(array("Hola", "como", "estas", "Hola"));
$d2 = new Documento(array("Hola", "que", "tal"));
$d3 = new Documento(array("Juan", "como", "estas"));

$corpus = new Corpus(array($d1, $d2, $d3));
$vocabulary = $corpus->getTerms();

$arrayDataRow = OcurrencesCollection::getData($vocabulary, $corpus->documents);
echo "<table><tr><th>Vocabulary</th><th>n</th><th>Ocurrences</th></tr>";
foreach($vocabulary as $count => $value){
    echo $arrayDataRow[$count]->toStringArray($value);
}
echo "</table>";

