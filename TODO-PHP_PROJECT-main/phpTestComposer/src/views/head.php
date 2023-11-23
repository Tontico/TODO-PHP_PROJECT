<?php

namespace Keha\Test\views;

use Keha\Test\Model\QueryParser;
//Class that create the Head
class Head
{
    public function displayHead()
    {
?>

        <head>
            <meta charset="UTF-8">
            <title>Gest'flex</title>
            <?php
            // Call the method to check the formName in the query if there is one
            $formName = QueryParser::getFormName();
            if ($formName !== null) { ?>
                <link rel="stylesheet" href="./public/login.css">
            <?php } else {
            ?>
                <link rel="stylesheet" href="./public/style.css">
                <link rel="stylesheet" href="./public/project.css">
            <?php
            }
            ?>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        </head>
<?php
    }
}
