<?php
function structureQuerywithCampos($words, $camposInput) {
    $queryWK = array();
    $docs = array();
    $camposArray = explode(",", $camposInput);
    $camposToSearch = [];
    for ($i = 0; $i < count($camposArray); $i++) {
        $nameTable = explode(".", $camposArray[$i]);
        array_push($camposToSearch, $nameTable[1]);
    }
    $tableToSearch = $nameTable[0];

    for ($i = 0; $i < count($camposToSearch); $i++) {
        $query = "SELECT KEYWORD_POST.Document_ID, " . $camposInput . " FROM " . $tableToSearch . " WHERE ";
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
                                $query .= $camposToSearch[$i] . " = '" . $wordToSearch . "'";
                            } else {
                                $wordToSearch = substr(strstr($words[$j], '('), 1); //elimina caracter "("
                                while (!strpos($words[$j], ")")) {
                                    $wordToSearch .= $words[$j] . " ";
                                    $queryWK[] = $words[$j];
                                    $j++;
                                }
                                $lastWord = str_replace(')', '', $words[$j]);
                                $wordToSearch .= $lastWord;
                                $queryWK[] = $lastWord;
                                $query .= $camposToSearch[$i] . " = '" . $wordToSearch . "'";
                            }
                            break;
                        case 'PATRON':
                            //echo "encontré un patrón()";
                            if(strpos($words[$j], ")")) {
                                $wordToSearch = substr(strstr($words[$j], '('), 1, -1);
                                $queryWK[] = $wordToSearch;
                                $query .= $camposToSearch[$i] . " LIKE '%" . $wordToSearch . "%'";
                            } else {
                                $wordToSearch = substr(strstr($words[$j], '('), 1); //elimina caracter "("
                                while (!strpos($words[$j], ")")) {
                                    $wordToSearch .= $words[$j] . " ";
                                    $queryWK[] = $words[$j];
                                    $j++;
                                }
                                $lastWord = str_replace(')', '', $words[$j]);
                                $wordToSearch .= $lastWord;
                                $queryWK[] = $lastWord;
                                $query .= $camposToSearch[$i] . " LIKE '%" . $wordToSearch . "%'";
                            }
                            break;
                        default:
                            //echo "encontré una palabra";
                            $query .= $camposToSearch[$i] . " LIKE '%" . $words[$j] . "%'";
                            $queryWK[] = $words[$j];
                            break;
                    }
                    break;
            }
        }
        echo "<br/>";
        var_dump($query);
        $arrayDocs[] = executeQuery($query, $camposToSearch);
        //$results = executeQuery($query);
        //printResults($results);
        $result = array();
        foreach ($arrayDocs as $docs) { //filtro de documentos para que no se repitan
            foreach ($docs as $doc) {
                if (!(in_array($doc, $result))) {
                    $result[] = $doc;
                }
            }
        }
        $resultKW = array();
        foreach ($queryWK as $wk) { //filtro de palabras para que no se repitan
            if (!(in_array($wk, $resultKW))) {
                $resultKW[] = $wk;
            }
        }

        $dto = array();
        $dto[] = $result;
        $dto[] = $resultKW; //detalles
        $dto[] = frequencyQueryKW2($resultKW, $words);
        return $dto;
    }
}

function frequencyQueryKW2($kws, $query){
    $frequency = array();
    foreach($kws as $kw){
        $count = 0;
        foreach($query as $querykw){
            $remove = array("CADENA", "PATRON", "(", ")");
            $querykw = str_replace($remove," ",$querykw);
            $querykw = trim($querykw);
            if(strtoupper($querykw) == strtoupper($kw)){
                $count++;
            }else{
            }
        }
        $frequency[] = $count;
    }
    return $frequency;
}
