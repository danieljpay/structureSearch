<?php
function structureQueryEmpresarial($query)
{
    $queryinitial = "Select Opinion, MATCH(Opinion) AGAINST('" . $query . "' IN BOOLEAN MODE) AS SCORE ";
    $queryend = "FROM opinions WHERE MATCH(Opinion) AGAINST ('" . $query . "' IN BOOLEAN MODE)";
    $querytotal = $queryinitial . $queryend;

    echo "<br>Query : " . $querytotal;
    $results = executeQuery($querytotal);
    echo "<br>Results: ";
    var_dump($results);
    echo "<br><br>";

    printResults($results);
}
