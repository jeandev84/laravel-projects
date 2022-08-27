<?php


if (! function_exists('splitName')) {

    function splitName(string $name) {

        $name = trim($name);

        $nameArray = explode(" ", $name);

        $firstName = $nameArray[0];
        $lastName  = $nameArray[1];

        return [$firstName, $lastName];
    }
}

