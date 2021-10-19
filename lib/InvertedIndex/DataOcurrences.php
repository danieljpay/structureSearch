<?php
class DataOcurrences
{
    public $frequencyDocuments;
    public $indexDocuments;
    public $indexTerms;

    public function __construct($indexDocuments, $indexTerms)
    {
        $this->frequencyDocuments = sizeof($indexDocuments);
        $this->indexDocuments = $indexDocuments; 
        $this->indexTerms = $indexTerms;
    }

    public function DTOrow1(){
        $array = array();
        $array[] = $this->indexDocuments[0];
        $array[] = count($this->indexTerms[0]);
        $list = "";
        foreach($this->indexTerms[0] as $count => $position){
            if($count == (count($this->indexTerms[0])-1)){
                $list .= $position;
            }else{
                $list .= $position . ",";
            }
        }
        $array[] = $list;
        return $array;
    }

    public function toStringData()
    {
        echo "Nueva row-----------------------";
        foreach($this->indexDocuments as $indexArray => $indexDocument){
            echo "<br>Id Documento: " . $indexDocument . "<br>";
            echo "Frecuencia de terms: " . sizeof($this->indexTerms[$indexArray]) . "<br>";
            echo "Posiciones: ";
            foreach($this->indexTerms[$indexArray] as $indexTerm){
                echo $indexTerm . "/";
            }
            echo "<br>";
        }
        echo "<br>";
    }

    public function toStringArray($term)
    {
        echo "<tr>";
            echo "<td>" . $term . "</td>";
            echo "<td>" . $this->frequencyDocuments . "</td>";
            echo "<td>";
            foreach($this->indexDocuments as $indexArray => $indexDocument){
                echo "[" . $indexDocument;
                echo "," . sizeof($this->indexTerms[$indexArray]);
                echo "[";
                for($i=0; $i<sizeof($this->indexTerms[$indexArray]); $i++){
                    echo $this->indexTerms[$indexArray][$i];
                    if($i<sizeof($this->indexTerms[$indexArray])-1){
                        echo ",";
                    }
                }
                echo "]]";
            }
            echo "</td></tr>";
    }
}