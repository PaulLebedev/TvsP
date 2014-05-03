<?php

function getRoom($rid)
{
    global $db;
    $rid = intval($rid);
    $results = $db->query("SELECT *, rooms.id as rid FROM rooms JOIN problems ON problems.id = rooms.problem_id WHERE rooms.id = " . $rid);
    $rows = array();
    if ($results) {
        foreach ($results as $r)
            $rows[] = $r;
        if (count($rows))
            return $rows[0];
    }
    return null;
}

function getUsersInRoom($rid)
{
    global $db;
    $rid = intval($rid);
    $results = $db->query("SELECT * FROM users
    JOIN rooms_to_users ON rooms_to_users.user_id = users.user_id
    JOIN rooms ON rooms.id = rooms_to_users.room_id WHERE rooms.id = " . $rid);
    $rows = array();
    if ($results) {
        foreach ($results as $r)
            $rows[] = $r;
        if (count($rows))
            return $rows;
    }
    return null;
}

function addUserToRoom($rid, $uid)
{
    global $db;
    $rid = intval($rid);
    $uid = intval($uid);
    $results = $db->query("INSERT INTO rooms_to_users (user_id, room_id) VALUES (" . $uid . "," . $rid . ")");
}

function removeUserFromRoom($rid, $uid)
{
    global $db;
    $rid = intval($rid);
    $uid = intval($uid);
    $results = $db->query("DELETE FROM rooms_to_users WHERE room_id = " . $rid . " AND user_id = " . $uid);
}

function setCaptain($rid, $uid){
    global $db;
    $rid = intval($rid);
    $uid = intval($uid);
    $results = $db->query("UPDATE rooms SET captain_user_id = " . $uid . " WHERE id = " . $rid );
}

function updateSolution($rid, $text){
    global $db;
    $rid = intval($rid);
    $text = intval($text);
    $query = $db->query("UPDATE rooms SET solution = '".$text."' WHERE id = " . $rid );
    //$query->bindValue(':sol', $text);
    //var_dump($query);
    //$results = $db->execute($query);
}

function launchRoom($rid){
    global $db;
    $rid = intval($rid);
    $query = $db->query("UPDATE rooms SET status = 'RUNNING' WHERE id = " . $rid );
}