<?php

require_once 'app/init.php';

if (isset($_GET['item'])) {

    $item_id = $_GET['item'];

    $delete = $dbh->prepare("DELETE FROM items WHERE id = $item_id ");

    if ($delete->execute(array(
        $id
    )));

    header('Location: index.php');
}
