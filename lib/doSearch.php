<?php
    include("structureQueryEmpresarial.php");

    if(isset( $_GET["inputSearch"] )) {
        $input = strtoupper($_GET["inputSearch"]);
        $words = explode(" ", $input);
        
        structureQueryEmpresarial($words);
    } else {
        echo "<p>Tus resultados se mostrarán aquí</p>";
    }
?>