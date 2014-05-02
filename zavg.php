<?php

require_once 'php-login-minimal/classes/Login.php';
require_once 'php-login-minimal/classes/Registration.php';
require_once 'php-login-minimal/config/db.php';

$login = new Login();

$authenticate = function ($login) {
    return function () use ($login) {
        if ( !$login->isUserLoggedIn()) {
            $app = \Slim\Slim::getInstance();
            $app->redirect('/');
        }
    };
};
$app->map('/', function () use ($app, $db, $login) {
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

$app->get('/list', $authenticate($login), function () use  ($app, $db)  {

});
