<?php
class OcurrencesCollection
{
    public static function getData($vocabulary, $documents){
        $data = array();
        foreach($vocabulary as $keyword){
            $dataRowDocuments = array();
            $dataRowTerms = array();
            foreach($documents as $indexDocument => $document){
                $positionTerms = array();
                foreach($document->terms as $indexTerm => $term){
                    if($term == $keyword){
                        $positionTerms[] = $indexTerm;
                    }
                }
                if(sizeof($positionTerms)!=0){
                    $dataRowDocuments[] = $indexDocument;
                    $dataRowTerms[] = $positionTerms;
                }
            }
            $data[] = new DataOcurrences($dataRowDocuments, $dataRowTerms); 
        }
        return $data;
    }
}