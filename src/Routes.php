<?php
declare(strict_types = 1);

return [
    ['GET', '/', function () {
        echo 'Home';
    }],
    ['GET', '/hello-world', function () {
        echo 'Hello World';
    }],
    ['GET', '/another-route', function () {
        echo 'This works too';
    }],
];
