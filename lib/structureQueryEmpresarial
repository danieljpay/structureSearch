<?php
function structureQueryEmpresarial($words)
{
    $remove = array("CADENA", "PATRON", "(", ")");
    $queryWK = array();
    $docs = array();
    $tableToSearch = "opinions";
    $columnSearch = "Opinion";
    $query = "";
    $queryinitial = "";
    $queryend = "";
    for ($i = 0; $i < 1; $i++) {
        $queryinitial = "Select " . $columnSearch . ", " . "MATCH(" . $columnSearch . ") AGAINST('";
        for ($j = 0; $j < count($words); $j++) {
            switch ($words[$j]) {
                case "AND":
                    $query .= " +";
                    break;
                case "OR":
                    $query .= " ";
                    break;
                case "NOT":
                    $query .= " -";
                    break;
                default:
                    switch (strstr($words[$j], '(', true)) {
                        case 'CADENA':
                            //echo "encontré una cadena()";
                            if (strpos($words[$j], ")")) {
                                /*  $wordToSearch = substr(strstr($words[$j], '('), 1, -1);
                                $queryWK[] = cleanKeyword($remove, $words[$j]); */
                                //$query .= "lala";
                            } else {
                                $wordToSearch = substr(strstr($words[$j], '('), 1); //elimina caracter "("
                                $queryWK[] = cleanKeyword($remove, $words[$j]);
                                while (!strpos($words[$j], ")")) {
                                    $j++;
                                    $wordToSearch .= " " . $words[$j];
                                    $queryWK[] = cleanKeyword($remove, $words[$j]);
                                }
                                $wordToSearch = substr($wordToSearch, 0, -1); //elimina caracter ")"
                                //$queryWK[] = $wordToSearch; Creo que no
                                //$query .=  "'";
                            }
                            break;
                        case 'PATRON':
                            //echo "encontré un patrón()";
                            if (strpos($words[$j], ")")) {
                                $wordToSearch = substr(strstr($words[$j], '('), 1, -1);
                                $queryWK[] = cleanKeyword($remove, $words[$j]);
                                // $query .=  "%'";
                            } else {
                                $wordToSearch = substr(strstr($words[$j], '('), 1); //elimina caracter "("
                                while (!strpos($words[$j], ")")) {
                                    $j++;
                                    $wordToSearch .= " " . $words[$j];
                                    $queryWK[] = cleanKeyword($remove, $words[$j]); //CREO
                                }
                                $wordToSearch = substr($wordToSearch, 0, -1); //elimina caracter ")"
                                //$queryWK[] = $wordToSearch; Creo que no
                                //$query .= "";
                            }
                            break;
                        default:
                            if($j == 0 && $words[$j+1] == 'AND'){
                                $query .= "+" . $words[$j];
                            }else{
                                $query .=  $words[$j];
                            }
                            break;
                    }
                    break;
            }
        }


        $queryend =   $query . "') AS Score FROM " . $tableToSearch . " WHERE MATCH(" . $columnSearch . ") AGAINST ('" . $query . "' IN BOOLEAN MODE)";
        //$query = "SELECT Opinion, MATCH(Opinion) AGAINST('alrededor' IN BOOLEAN MODE) AS Score FROM opinions WHERE MATCH(Opinion) AGAINST ('alrededor' IN BOOLEAN MODE)";
        $querytotal = $queryinitial . $queryend;
        echo "<br>";
        echo $querytotal;
        $results = executeQuery($querytotal);
        var_dump($results);
        echo "<br>";

        foreach ($results as $key => $column) {
            echo "<br> Contenido " . $key;
            foreach ($column as $content) {
                echo "<br>";
                echo $content;
            }
        }
    }
}


