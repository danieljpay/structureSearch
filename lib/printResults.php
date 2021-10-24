<?php
function printResults($results)
{
    //var_dump($results);
    if ($results) {
        foreach ($results as $doc) {
            echo "<div class='results-card'>";
            $id = $doc[0];
            echo "<p>";
            echo "ID: " . $id;
            echo "</p>";

            echo "<p>";
            echo "Contenido: " . getDocContent($id);
            echo "</p>";

            echo "<p>";
            $path = __DIR__ . "\\";
            downloadDocument(intval($id), $path);
            echo "</p>";

            echo "<p>";
            echo "Valor de similitud del coseno: " . $doc[1];//Valor de similitud de coseno
            echo "</p>";

            echo "</div>";
        }
        echo "<br/>";
    } else {
        echo "<p>No se encontraron resultados</p>";
    }
}
