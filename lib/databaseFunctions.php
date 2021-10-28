<?php
function connectDB() {
    $connection = mysqli_connect("127.0.0.1", "root", "", "empresarial");
    if (!$connection) {
        die("Fail: " . mysqli_connect_error());
    }
    return $connection;
}

function closeConnectionBD($connection) {
    mysqli_close($connection);
}

function executeQuery($query) {
    $connection = connectDB();
    $queryResults = mysqli_query($connection, $query);
    echo "<br>";
    if ($queryResults) {
        $arrayResults = readQueryResults($queryResults);
    } else {
        $arrayResults = array();
    }

    closeConnectionBD($connection);
    return $arrayResults;
}

function readQueryResults($results) {
    $arrayResults = array();
    while ($fila = mysqli_fetch_assoc($results)) {
        $arrayResults[] = $fila;
    }
    return $arrayResults;
}

function updateDB($query) {
    $connection = connectDB();
    $done = mysqli_query($connection, $query);
    closeConnectionBD($connection);
    return $done;
}

function insertFile($content) {
    $query = "INSERT INTO opinions (Opinion) VALUES ('" . $content . "');";
    return updateDB($query);
}

function getDocContent($documentID) {
    $query = "SELECT posting.Document_Content FROM posting WHERE Document_ID = " . $documentID . ";";
    $content = executeQuery($query);
    if (!empty($content)) {
        return unpackResults($content,"Document_Content");
    } else {
        return "404 NOT FOUND :(";
    }
}

function validationDocumentTxt($id_document) {
    $dataFile = getDocContent($id_document);
    if ($dataFile != "404 NOT FOUND :(") {
        return true;
    }
    return false;
}

function createDocumentTxt($id_document, $path) {
    $fileName = "document_$id_document.txt";
    $dataFile = getDocContent($id_document);
    if ($dataFile !=  "404 NOT FOUND :(") {
        file_put_contents($path . "documents/" . $fileName, $dataFile);
    }
}

function getFilesDocuments($id_document, $path) {
    $files = scandir($path . "documents/");
    if (!in_array("document_$id_document.txt", $files)) {
        createDocumentTxt($id_document, $path);
    }
    return $files;
}

function downloadDocument($id_document, $path) {
    if (validationDocumentTxt($id_document, $path)) {
        getFilesDocuments($id_document, $path); //En caso de que necesite crear documento.
        $files = getFilesDocuments($id_document, $path);
        for ($i = 2; $i < count($files); $i++) {
            if ($files[$i] == "document_$id_document.txt") {
            ?>
                <?php echo "Descargue su documento: " ?><a download="<?php echo $files[$i] ?>" href="<?php echo "../lib/" ?>documents/<?php echo $files[$i] ?>"><?php echo $files[$i] . "<br>" ?></a>
            <?php
            }
        }
    } else {
        echo "Documento no encontrado en DB";
    }
}

function unpackResults ($results, $criterion) {
    $unpackedResults = array ();
    foreach ($results as $result) {
        $unpackedResults[] = $result[$criterion];
    }

    if (count($unpackedResults) == 1) {
        return $unpackedResults[0];
    }else {
        return $unpackedResults;
    }
}