<?php
include ("Documento.php");
include ("Corpus.php");
include ("DataInvertedIndex.php");
include ("DataOcurrences.php");
include ("functions.php");

$d1 = generatorDocuments(listdocuments());

$corpus = new Corpus($d1);
$vocabulary = $corpus->getTerms();

$arrayDataRow = OcurrencesCollection::getData($vocabulary, $corpus->documents);

echo "<table><tr><th>Vocabulary</th><th>n</th><th>Ocurrences</th></tr>";
foreach($vocabulary as $count => $value){
    echo $arrayDataRow[$count]->toStringArray($value);
}
echo "</table>";

