<?php

require_once 'vendor/autoload.php';

$app = new \Slim\Slim();

require_once "config.php";
require_once "zavg.php";

$app->run();
