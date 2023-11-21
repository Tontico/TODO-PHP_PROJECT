<?php

namespace Keha\Test\views;

//Class that create the Head
class Head
{
    public function displayHead()
    {
?>

        <head>
            <meta charset="UTF-8">
            <title>Mange tes morts</title>
            <link rel="stylesheet" href="./public/style.css">
            <link rel="stylesheet" href="./public/login.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
            <style>
                html,
                body {
                    height: 100%;
                }

                .form-signin {
                    max-width: 330px;
                    padding: 1rem;
                }

                .form-signin .form-floating:focus-within {
                    z-index: 2;
                }

                .form-signin input[type="email"] {
                    margin-bottom: -1px;
                    border-bottom-right-radius: 0;
                    border-bottom-left-radius: 0;
                }

                .form-signin input[type="password"] {
                    margin-bottom: 10px;
                    border-top-left-radius: 0;
                    border-top-right-radius: 0;
                }
            </style>
        </head>
<?php
    }
}
