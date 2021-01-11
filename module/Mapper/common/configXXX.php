<?php


namespace Mapper;

$serverName = $_SERVER['SERVER_NAME'];

if ($serverName == 'localhost') {
    return [
        'db' => [
            'host' => 'XXX',
            'username' => 'XXX',
            'password' => 'XXX',
            'name' => 'XXX'
        ]
    ];
} else {
    return [
        'db' => [
            'host' => 'XXX',
            'username' => 'XXX',
            'password' => 'XXX',
            'name' => 'XXX'
        ]
    ];
}


