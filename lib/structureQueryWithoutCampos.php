<?php
function structureQueryWithoutCampos($words)
{
    $remove = array("CADENA", "PATRON", "(", ")");
    $queryWK = array();
    $docs = array();
    $categoriasBusqueda = ["Keyword"];
    $tableToSearch = "keyword_post";
    for ($i = 0; $i < count($categoriasBusqueda); $i++) {
        $query = "SELECT keyword_post.Document_ID FROM " . $tableToSearch . " WHERE ";
        for ($j = 0; $j < count($words); $j++) {
            switch ($words[$j]) {
                case "AND":
                    $query .= " AND ";
                    break;
                case "OR":
                    $query .= " OR ";
                    break;
                case "NOT":
                    $query .= "NOT ";
                    break;
                default:
                    switch (strstr($words[$j], '(', true)) {
                        case 'CADENA':
                            //echo "encontré una cadena()";
                            if (strpos($words[$j], ")")) {
                                $wordToSearch = substr(strstr($words[$j], '('), 1, -1);
                                $queryWK[] = cleanKeyword($remove, $words[$j]);
                                $query .= $categoriasBusqueda[$i] . " = '" . $wordToSearch . "'";
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
                                $query .= $categoriasBusqueda[$i] . " = '" . $wordToSearch . "'";
                            }
                            break;
                        case 'PATRON':
                            //echo "encontré un patrón()";
                            if (strpos($words[$j], ")")) {
                                $wordToSearch = substr(strstr($words[$j], '('), 1, -1);
                                $queryWK[] = cleanKeyword($remove, $words[$j]);
                                $query .= $categoriasBusqueda[$i] . " LIKE '%" . $wordToSearch . "%'";
                            } else {
                                $wordToSearch = substr(strstr($words[$j], '('), 1); //elimina caracter "("
                                while (!strpos($words[$j], ")")) {
                                    $j++;
                                    $wordToSearch .= " " . $words[$j];
                                    $queryWK[] = cleanKeyword($remove, $words[$j]); //CREO
                                }
                                $wordToSearch = substr($wordToSearch, 0, -1); //elimina caracter ")"
                                //$queryWK[] = $wordToSearch; Creo que no
                                $query .= $categoriasBusqueda[$i] . " LIKE '%" . $wordToSearch . "%'";
                            }
                            break;
                        default:
                            //echo "encontré una palabra";
                            $query .= $categoriasBusqueda[$i] . " LIKE '%" . $words[$j] . "%'";
                            $queryWK[] = cleanKeyword($remove, $words[$j]);
                            break;
                    }
                    break;
            }
        }

         echo "<br/>";
        $arrayDocs[] = executeQuery($query, $categoriasBusqueda); 
        //echo $query;
        $arrayDocs = executeQuery($query, $categoriasBusqueda); 
        //var_dump($arrayDocs);
    }


    $result = array();
    foreach ($arrayDocs as $docs) {
        foreach ($docs as $doc) {
            if (!(in_array($doc, $result))) {
                $result[] = $doc;
            }
        }
    }
    var_dump($result);

    $resultKW = array();
    foreach ($queryWK as $wk) {
        if (!(in_array($wk, $resultKW))) {
            $resultKW[] = $wk;
        }
    }

    $dto = array();
    $dto[] = $result;
    $dto[] = $resultKW; //detalles
    $dto[] = frequencyQueryKW($resultKW, $words);
    return $dto;
    //printResults($result); */

}

function frequencyQueryKW($kws, $query)
{
    $remove = array("CADENA", "PATRON", "(", ")");
    $frequency = array();

    foreach ($kws as $kw) {
        $count = 0;
        foreach ($query as $querykw) {
            $querykw = cleanKeyword($remove, $querykw);
            if (strtoupper($querykw) == strtoupper($kw)) {
                $count++;
            } else {
            }
        }
        $frequency[] = $count;
    }
    return $frequency;
}

function cleanKeyword($remove, $word)
{
    $replaced = str_replace($remove, " ", $word);
    return trim($replaced);
}
