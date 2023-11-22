<?php

namespace Keha\Test\Model;

final class QueryParser
{

    //Method to Parse the query string to fin the formName
    private static function parseQueryString()
    {
        $queryString = $_SERVER['QUERY_STRING'];
        parse_str($queryString, $queryArray);
        if (isset($queryArray['formName'])) {
            return $queryArray['formName'];
        } else {
            return null;
        }
    }

    //Processes the formName value, and removing display, then convert to lower
    private static function processFormName($formName)
    {
        if ($formName !== null && strpos($formName, "display") !== false) {
            return strtolower(str_replace("display", "", $formName));
        }
        return $formName;
    }

    // Gets the processed formName value from the query string
    public static function getFormName()
    {
        $formName = self::parseQueryString();
        if ($formName !== null) {
            return self::processFormName($formName);
        } else {
            return null;
        }
    }
}
