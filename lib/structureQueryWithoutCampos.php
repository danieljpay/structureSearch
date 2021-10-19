<?php
    function structureQueryWithoutCampos($words) {
        $docs = array();
        $categoriasBusqueda = ["Keyword", "Document_ID", "Frecuency","Positions"];
        $tableToSearch = "keyword_post";
        for ($i=0; $i < count($categoriasBusqueda); $i++) {
            $query = "SELECT " . "keyword_post.Keyword, keyword_post.Document_ID, keyword_post.Frequency, keyword_post.Positions" . " FROM " . $tableToSearch . " WHERE ";
            for ($j=0; $j < count($words); $j++) { 
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
                        switch ( strstr($words[$j], '(', true) ) {
                            case 'CADENA':
                                //echo "encontré una cadena()";
                                if(strpos($words[$j], ")")) {
                                    $wordToSearch = substr(strstr($words[$j], '('), 1, -1);
                                    $query .= $categoriasBusqueda[$i] . " = '" . $wordToSearch ."'";
                                } else {
                                    $wordToSearch = substr(strstr($words[$j], '('), 1); //elimina caracter "("
                                    while(!strpos($words[$j], ")")) {
                                        $j++;
                                        $wordToSearch .= " " . $words[$j];
                                    }
                                    $wordToSearch = substr($wordToSearch, 0 , -1); //elimina caracter ")"
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
                                break;
                        }
                        break;
                }
            }
            $arrayDocs[] = executeQuery($query,$categoriasBusqueda);
        }
        $result = array();
        foreach($arrayDocs as $docs){
            foreach($docs as $doc){
                if(!(in_array($doc, $result))){
                    $result[] = $doc;
                }
            }
        }
        printResults($result);
    }
?>