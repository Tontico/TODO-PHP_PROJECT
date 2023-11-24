<?php

namespace Keha\Test\views;

use Keha\Test\Model\QueryParser;
//Class that create the Head
class Head
{
    public function displayHead()
    {
        if (isset($_POST['mode'])) {
            if ($_SESSION['mode']==="Dark"){
                $_SESSION['mode'] = "Light";
                
            } else{
                $_SESSION['mode'] = "Dark";
            }
        }
?>
        <!DOCTYPE html>
        <html lang="fr">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Gest'flex</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
            <?php
            // Call the method to check the formName in the query if there is one
            $formName = QueryParser::getFormName();
            if ($formName !== null) { ?>
                <link rel="stylesheet" href="./public/login.css">
            <?php } else {
                if ($_SESSION['mode'] === "Dark") {
                    echo "<link rel='stylesheet' href='./public/stylelight.css'>
                <link rel='stylesheet' href='./public/projectlight.css'>";
                } else {
                    echo " <link rel='stylesheet' href='./public/style.css'>
                    <link rel='stylesheet' href='./public/project.css'>";
                }
            }
            ?>
            
        </head>
<?php
    }
}
