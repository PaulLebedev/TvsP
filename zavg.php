<?php

require_once 'php-login-minimal/classes/Login.php';
require_once 'php-login-minimal/classes/Registration.php';
require_once 'php-login-minimal/config/db.php';

$login = new Login();

$authenticate = function ($login) {
    return function () use ($login) {
        if (!$login->isUserLoggedIn()) {
            $app = \Slim\Slim::getInstance();
            $app->redirect('/');
        }
    };
};

$app->map('/', function () use ($app, $db, $login) {
    if ($login->isUserLoggedIn())
        $app->redirect("/list/IT");
    else
        $app->render(
            'layout.php',
            array('app' => $app, 'view' => 'main', 'login' => $login)
        );
})->via('GET', 'POST');

$app->map('/register', function () use ($app, $db, $login) {
    $registration = new Registration();
    $app->render(
        'layout.php',
        array('app' => $app, 'view' => 'register', 'registration' => $registration, 'login' => $login)
    );
})->via('GET', 'POST');

$app->get('/room', $authenticate($login), function () use ($app, $db, $login) {
    $rid = $app->request->get("rid");
    $room = getRoom($rid);
    $usersInRoom = getUsersInRoom($rid);
    //$agreed = json_decode($room['agreed']);
    //$participants = json_decode($room['participants']);


    if (count($usersInRoom) == 0) {
        setCaptain($rid, $_SESSION["user_id"]);
        $cap = true;
    } else
        $cap = ($room['captain_user_id'] == $_SESSION['user_id']);
    $alreadyInRoom = false;
    if ($usersInRoom)
        foreach ($usersInRoom as $user)
            if ($user['user_id'] == $_SESSION["user_id"])
                $alreadyInRoom = true;
    if (!$alreadyInRoom and (count($usersInRoom) >= $room['participants']))
        $app->redirect('/');
    if (!$alreadyInRoom)
        addUserToRoom($rid, $_SESSION["user_id"]);
    $usersInRoom = getUsersInRoom($rid);
    $app->render(
        'layout.php',
        array('app' => $app, 'view' => 'room', 'room' => $room, 'login' => $login,
            'users' => $usersInRoom, 'viewer_id' => $_SESSION['user_id'], 'user_name' => $_SESSION['user_name'], 'cap' => $cap)
    );
});

$app->get('/get-room', $authenticate($login), function () use ($app, $db) {
    $rid = $app->request->get("rid");
    echo json_encode(getRoom($rid));
});

$app->get('/launch', $authenticate($login), function () use ($app, $db) {
    $rid = $app->request->get("rid");
    launchRoom($rid);
});

$app->get('/about', function () use ($app, $db, $login) {
    $app->render(
        'layout.php',
        array('app' => $app, 'view' => 'about', 'login' => $login)
    );
});

$app->get('/leave-room', $authenticate($login), function () use ($app, $db) {
    $rid = $app->request->get("rid");
    removeUserFromRoom($rid, $_SESSION['user_id']);
    $app->redirect('/');
});

$app->get('/update-solution', $authenticate($login), function () use ($app, $db) {
    $rid = $app->request->get("rid");
    $text = $app->request->get("text");
    $text = intval($text);
    updateSolution($rid, $text);
    //$app->redirect('/');
});

$app->get('/get-users', $authenticate($login), function () use ($app, $db) {
    $rid = $app->request->get("rid");
    $users = getUsersInRoom($rid);
    echo json_encode($users);
});

$app->get('/agree', $authenticate($login), function () use ($app, $db) {
    $rid = $app->request->get("uid");
    $room = getRoom($rid);
    $usersInRoom = getUsersInRoom($rid);
    $app->render(
        'layout.php',
        array('app' => $app, 'view' => 'room', 'room' => $room, 'users' => $usersInRoom, 'viewer_id' => $_SESSION['user_id'])
    );

});
