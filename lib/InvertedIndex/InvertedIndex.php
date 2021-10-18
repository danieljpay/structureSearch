<?php
function startInvertedIndex($content, $id)
{
    include("Documento.php");
    include("Corpus.php");
    include("DataInvertedIndex.php");
    include("DataOcurrences.php");
    include("functions.php");

    $documents = generatorDocuments(listdocuments($content), $id);
    $corpus = new Corpus($documents);
    $vocabulary = $corpus->getTerms();
    $arrayDataRow = OcurrencesCollection::getData($vocabulary, $corpus->documents);
    echo "<table><tr><th>Vocabulary</th><th>n</th><th>Ocurrences</th></tr>";
    foreach ($vocabulary as $count => $value) {
        echo $arrayDataRow[$count]->toStringArray($value);
    }
    echo "</table>";
}
