<?php
function structureQueryWithoutCampos($words)
{
    $queryWK = array();
    $docs = array();
    $categoriasBusqueda = ["Keyword", "Document_ID", "Frecuency", "Positions"];
    $tableToSearch = "keyword_post";
    for ($i = 0; $i < count($categoriasBusqueda); $i++) {
        $query = "SELECT " . "keyword_post.Keyword, keyword_post.Document_ID, keyword_post.Frequency, keyword_post.Positions" . " FROM " . $tableToSearch . " WHERE ";
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
                                $queryWK[] = $wordToSearch;
                                $query .= $categoriasBusqueda[$i] . " = '" . $wordToSearch . "'";
                            } else {
                                $wordToSearch = substr(strstr($words[$j], '('), 1); //elimina caracter "("
                                while (!strpos($words[$j], ")")) {
                                    $j++;
                                    $wordToSearch .= " " . $words[$j];
                                    $queryWK[] = $wordToSearch;
                                }
                                $wordToSearch = substr($wordToSearch, 0, -1); //elimina caracter ")"
                                $queryWK[] = $wordToSearch;
                                $query .= $categoriasBusqueda[$i] . " = '" . $wordToSearch . "'";
                            }
                            break;
                        case 'PATRON':
                            //echo "encontré un patrón()";
                            $wordToSearch = substr(strstr($words[$j], '('), 1, -1);
                            $query .= $categoriasBusqueda[$i] . " LIKE '%" . $wordToSearch . "%'";
                            break;
                        default:
                            //echo "encontré una palabra";
                            $query .= $categoriasBusqueda[$i] . " LIKE '%" . $words[$j] . "%'";
                            $queryWK[] = $words[$j];
                            break;
                    }
                    break;
            }
        }
        $arrayDocs[] = executeQuery($query, $categoriasBusqueda);
    }
    $result = array();
    foreach ($arrayDocs as $docs) {
        foreach ($docs as $doc) {
            if (!(in_array($doc, $result))) {
                $result[] = $doc;
            }
        }
    }
    $resultKW = array();
    foreach ($queryWK as $wk) {
        if (!(in_array($wk, $resultKW))) {
            $resultKW[] = $wk;
        }
    }

    $dto = array();
    $dto[] = $result;
    $dto[] = $resultKW;//detalles
    $dto[] = frequencyQueryKW($resultKW, $words);
    return $dto;
    //printResults($result);
}

function frequencyQueryKW($kws, $query){
    $frequency = array();
    foreach($kws as $kw){
        $count = 0;
        foreach($query as $querykw){
            if(strtoupper($querykw) == strtoupper($kw)){
                $count++;
            }
        }
        $frequency[] = $count;
    }
    return $frequency;
}
