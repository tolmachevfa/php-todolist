<?php

session_start();

$_SESSION['user_id'] = 1;

$dbh = new PDO('mysql:dbname=todo; host=localhost', 'root', 'root');

if(!isset($_SESSION['user_id'])) {
    die('You are not signed in.');
}

?>