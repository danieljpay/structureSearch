<?php

include("Documento.php");

function listdocuments()
{
    $documentslist = array();
    $Document1 = "Lorem; ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse ut metus. Proin venenatis turpis sit amet ante consequat semper. Aenean nunc. Duis iaculis odio id lectus. Integer dapibus justo vitae elit. Nunc luctus, tortor quis iaculis tempus, urna odio iaculis erat, imperdiet lobortis orci lectus at eros. Ut a velit id odio malesuada nonummy. Aenean cursus metus a purus.";
    $Document2 = "Duis dapibus odio a enim. Aliquam ut diam sed nisl imperdiet gravida. Proin eget tellus ut ante dignissim dictum. Integer ut justo quis eros feugiat convallis. Praesent massa. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla egestas, nibh at malesuada nonummy, mi augue condimentum velit, a facilisis tortor ipsum non diam.";

    $documentslist[] = $Document1;
    $documentslist[] = $Document2;

    return $documentslist;
}


function generatorDocuments($documentslist)
{
    $documents = $documentslist;
    $documents_array = array();

    for ($j = 0; $j < count($documents); $j++) {
        $Document = removeCharacters($documents[$j]);
        $array_terms = generatorTerms($Document);
        $documents_array[] = new Documento($j+1,$array_terms);
    }

    return $documents_array;
}

function generatorTerms($document)
{
    $breakSpace = explode(" ", $document);
    return $breakSpace;
}

//Remueve los caracteres especiales definidos por nosotros , . o ; 
function removeCharacters($document)
{
    $result = str_replace(array(",", ".", ";"), '', $document);
    return $result;
}

function indexInverted($documents)
{

    $index_array = array();

    //Relacion entre el termino y el documento correspondiente.
    for ($j = 0; $j < count($documents); $j++) {
        $termsDocument = $documents[$j]->getTerms();
        // echo "Documento: " . $j;
        for ($i = 0; $i < count($termsDocument); $i++) {
            $index = array('Termino' => $termsDocument[$i], 'Documento' => $j);
            $index_array[] = $index;
        }
    }

    //Imprimir el array FUNCIONA DE AMBAS FORMAS. con el Foreach o el for normal.
    /*
    for($j = 0; $j < count($index_array); $j++){
        foreach($index_array[$j] as $encabezado => $valor) {
            echo "<br> $encabezado = $valor";
        }
    }
    */

    for ($j = 0; $j < count($index_array); $j++) {
        //echo "<br> Termino: " . $index_array[$j]['Termino'] . " --- Documento: ". $index_array[$j]['Documento'];
        echo "<br>";
        var_dump($index_array[$j]);
    }
}


function printDocuments()
{
    $documentslist = listdocuments();
    $documents = generatorDocuments($documentslist);

    for ($j = 0; $j < count($documents); $j++) {
        echo "<br> ID documento: " . $documents[$j]->getId() . " <br> Terminos: <br> " . $documents[$j]->toStringTerms();
    }

    /*
    echo "<br> INDEXADO: ";

    indexInverted($documents);
    */
}
