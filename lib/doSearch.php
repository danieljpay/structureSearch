<?php
    include("printResults.php");
    include("structureQueryEmpresarial.php");
    include("databaseFunctions.php");

    if(isset( $_GET["inputSearch"] )) {
        $input = $_GET["inputSearch"];
        structureQueryEmpresarial($input);
    } else {
        echo "<p>Tus resultados se mostrarán aquí</p>";
    }
?>