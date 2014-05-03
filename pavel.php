<?php

ini_set('display_errors', '1');
error_reporting(E_ALL);

$app->get('/list', $authenticate($login), function () use ($app, $db, $login) {
    $query = $db->prepare('SELECT * from categories');
    $query->execute();
    $categories = $query->fetchAll(PDO::FETCH_ASSOC);

    $app->render(
            'layout.php', array('app' => $app,
        'view' => 'list',
        'categories' => $categories,
        'login' => $login)
    );
});

$app->get('/profile', $authenticate($login), function () use ($app, $db, $login) {
    $app->redirect('/profile/' . $_SESSION['user_id']);
});

$app->get('/profile/:userid', $authenticate($login), function ($userid) use ($app, $db, $login) {
    $query = $db->prepare('SELECT * '
            . 'from users '
            . 'where users.user_id= :userid');
    $query->bindValue(':userid', $userid);
    $query->execute();
    $userData = $query->fetch(PDO::FETCH_ASSOC);

    $app->render(
            'layout.php', array('app' => $app,
        'view' => 'profile',
        'login' => $login,
        'userData' => $userData)
    );
});

$app->get('/error', $authenticate($login), function () use ($app, $db, $login) {
    die(var_dump($app->error));
});

$app->get('/list/:category', $authenticate($login), function ($category) use ($app, $db, $login) {
    $query = $db->prepare('SELECT * from categories');
    $query->execute();
    $categories = $query->fetchAll(PDO::FETCH_ASSOC);

    $query = $db->prepare('SELECT DISTINCT rooms.id,  problems.preview, problems.title, problems.participants, problems.rating, problems.cost, problems.mode '
            . 'from rooms '
            . 'join problems on rooms.problem_id=problems.id '
            . 'join tags_to_problems on tags_to_problems.problem_id=problems.id '
            . 'join tags on tags.id=tags_to_problems.tag_id '
            . 'join categories on categories.id=tags.category_id '
            . 'where rooms.status="WAITING_FOR_USERS" and categories.name = :category');
    $query->bindValue(':category', $category);
    $query->execute();
    $rooms = $query->fetchAll(PDO::FETCH_ASSOC);

    $roomsResults = array();
    foreach ($rooms as $room) {
        $query = $db->prepare('SELECT count(*) as count '
                . 'from rooms '
                . 'join rooms_to_users on rooms.id=rooms_to_users. room_id');
        $query->execute();
        $count = $query->fetch(PDO::FETCH_ASSOC);
        $room['count'] = $count['count'];
        $roomsResults[] = $room;
    }

    $query = $db->prepare('SELECT * from problems');
    $query->execute();
    $tasks = $query->fetchAll(PDO::FETCH_ASSOC);

    $app->render(
            'layout.php', array('app' => $app,
        'view' => 'list',
        'categories' => $categories,
        'rooms' => $roomsResults,
        'entered' => $category,
        'login' => $login,
        'tasks' => $tasks)
    );
});

$app->post('/room-create', $authenticate($login), function () use ($app, $db) {
    $data = $app->request()->post();
    if ($data['problem_id']) {
        $query = $db->prepare('SELECT * from problems where id=:id');
        $query->bindValue(':id', $data['problem_id']);
        $query->execute();
        $problem = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!count($problem) == 1) {
            $app->flash('error', 'cannot create a room');
            $app->redirect('/error');
        }
        $roomData = array('id' => NULL,
            'problem_id' => $problem[0]['id'],
            'deadline' => 0,
            'status' => 'WAITING_FOR_USERS',
            'solution' => '',
            'captain_user_id' => $_SESSION['user_id'],
            'date_of_creation' => date("Y-m-d H:i:s"),
            'agreed' => '');
        $result = $db->query('INSERT INTO `tvsp`.`rooms` (' . '`' . join('`, `', array_keys($roomData)) . '`' . ') VALUES (' . '"' . join('", "', $roomData) . '"' . ')');
        if ($result) {
            $app->redirect('/room?rid=' . $db->lastInsertId());
        }
    }
});
