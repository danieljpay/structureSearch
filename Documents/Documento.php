<?php
class Documento
{
    public $terms;

    public function __construct($terms)
    {
        $this->terms = $terms;
    }
    public function toStringTerms()
    {
        $list = "";
        foreach($this->terms as $value){
            $list .= $value . "<br>";
        }
        return $list;
    }
}