<?php
class Corpus
{
    public $documents;

    public function __construct($documents)
    {
        $this->documents = $documents;
    }

    public function getTerms()
    {
        $vocabulary = array();
        foreach ($this->documents as $document) {
            foreach ($document->terms as $term) {
                if (!($this->isInVocabulary($vocabulary, $term))) {
                    $vocabulary[] = $term;
                }
            }
        }
        return $vocabulary;
    }

    public function isInVocabulary($vocabulary, $termDocument)
    {
        foreach ($vocabulary as $term) {
            if ($term == $termDocument) {
                return true;
            }
        }
        return false;
    }
}
