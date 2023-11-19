<?php

namespace Keha\Test\Model;

// Function to get user data
class GetUser
{
    public static function getUser($username, $datas)
    {
        // Check if the username exists
        if (array_key_exists($username, $datas)) {
            return $datas[$username];
        }
        return false;
    }
}
