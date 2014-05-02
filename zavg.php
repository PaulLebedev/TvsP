<?php

require_once 'php-login-minimal/classes/Login.php';
require_once 'php-login-minimal/classes/Registration.php';
require_once 'php-login-minimal/config/db.php';

$app->map('/', function () use ($app, $db) {
    $login = new Login();
    $app->render(
        'layout.php',
        array('app' => $app, 'view' => 'main', 'login' => $login)
    );
})->via('GET', 'POST');

$app->map('/register', function () use ($app, $db)  {
    $registration = new Registration();
    $app->render(
        'layout.php',
        array('app' => $app, 'view' => 'register', 'registration' => $registration)
    );
})->via('GET', 'POST');
