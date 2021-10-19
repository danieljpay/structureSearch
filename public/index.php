<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Query languages</title>
    <link rel="shortcut icon" href="assets/favicon.png">
    <style type="text/css">@import url("../src/styles/index.css");</style>
</head>
<body>
    <?php
        echo "<h1 class='pageTitle'>Query languages</h1>";
        include("../src/components/Searcher.html");

        echo "<div class='results'>";
            include("../src/components/FormUploadFile.html");
        echo "</div>";

        echo "<hr/>";

        echo "<br/><br/>";

        echo "<div class='results'>";
            include("../lib/doSearch.php");
        echo "</div>";
    ?>
</body>
</html>