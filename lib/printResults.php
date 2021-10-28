<?php
function printResults($results)
{
    //var_dump($results);
    if ($results) {
        /* echo "<p>";
        $path = __DIR__ . "\\";
        downloadDocument(intval($id), $path);
        echo "</p>"; */
        foreach ($results as $key => $column) {
            echo "<div class='results-card'>";
            echo "<p> No: " . $key . "</p>";
            echo "<p> Contenido: " . $column['Opinion'] . "</p>";
            echo "<p> Contenido: " . $column['SCORE'] . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p>No se encontraron resultados</p>";
    }
}
