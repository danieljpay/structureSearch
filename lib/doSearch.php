<?php
    include("analyzerInput.php");

    if(isset( $_GET["inputSearch"] )) {
        $input = strtoupper($_GET["inputSearch"]);
        $words = explode(" ", $input);
        
        analyzerInput($words);
    } else {
        echo "<p>Tus resultados se mostrarán aquí</p>";
    }
?>