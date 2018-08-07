<?php

require_once 'app/init.php';

$itemsQuery = $dbh->prepare("
    SELECT id, name, done
    FROM items
    WHERE user = :user
");

$itemsQuery->execute([
    'user' => $_SESSION['user_id']
]);

$items = $itemsQuery->rowCount() ? $itemsQuery : [];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Shadows+Into+Light+Two" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <div class="list">
        <h1 class="header">To do</h1>
        <form class="item-add" action="add.php" method="POST">
            <input type="text" name="name" placeholder="Type a new task here" class="input" required>
            <input type="submit" value="Add" class="submit">
        </form>

        <?php if(!empty($items)):?>
        <ul class="items">
            <?php foreach($items as $item): ?>
                <li class="string">
                    <span class="item<?php echo $item['done'] ? ' done' : '' ?>"><?php echo $item['name']; ?></span>
                    <?php if(!$item['done']): ?>
                        <a href="mark.php?as=done&item=<?php echo $item['id'] ?>" class="done-button">&#10004;</a>
                    <?php else: ?>
                        <a href="mark.php?as=notdone&item=<?php echo $item['id'] ?>" class="notdone-button">&#9100;</a>
                    <?php endif; ?>
                    <a href="del.php?item=<?php echo $item['id'] ?>" class="delete-button">&#10007;</a>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php else: ?>
            <p>You haven't added any task yet</p>
        <?php endif; ?>
    </div>
</body>

</html>