<?php
    include("databaseFunctions.php");
    include("printResults.php");
    include("structureQueryWithCampos.php");
    include("structureQueryWithoutCampos.php");
    include("CosineSimilarity/start.php");
    include("InvertedIndex/functions.php");
    include("StructureQueryEmpresarial");
    
    function analyzerInput($words) {
        //Detección de campos
      /*   $camposInput = lookCamposInput($words);
        $hasCamposInput = $camposInput ? true : false;
        if($hasCamposInput) {
            $words = deleteCamposFromWords($words);
            startCosineSimilarity(structureQueryWithCampos($words, $camposInput));
            var_dump(structureQueryWithCampos($words, $camposInput));
        } else {
           structureQueryWithoutCampos($words);
        } */
        //$results = array();

        structureQueryEmpresarial($words);

      /*   $query = "SELECT * FROM opinions WHERE MATCH(Opinion) AGAINST ('alrededor')";
        $results = executeQuery($query);
        var_dump($results); */
    }

    function lookCamposInput($words) {
        for ($i=0; $i < count($words); $i++) { 
            if(strstr($words[$i], '(', true) == "CAMPOS") {
                $camposValue = substr(strstr($words[$i], '('), 1); //elimina caracter "("
                while(!strpos($words[$i], ")")) {
                    $i++;
                    $camposValue .= " " . $words[$i];
                }
                $camposValue = substr($camposValue, 0 , -1); //elimina caracter ")"
                return $camposValue;
            }
        }
        return "";
    }

    function deleteCamposFromWords($words) {
        for ($i=0; $i < count($words); $i++) { 
            if(strstr($words[$i], '(', true) == "CAMPOS") {
                while(!strpos($words[$i], ")")) {
                    $i++;
                    unset($words[$i-1]);
                }
                if(strpos($words[$i], ')')) { //para eliminar el último elemento
                    unset($words[$i]);   
                }
            }
        }
        return $words;
    }
?>