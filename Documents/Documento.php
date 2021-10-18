<?php
class Documento
{
    public $id;
    public $terms;

    public function __construct($id,$terms)
    {
        $this->id = $id;
        $this->terms = $terms;
    }

    public function getTerms(){
        return $this->terms;
    }

    public function getId(){
        return $this->id;
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