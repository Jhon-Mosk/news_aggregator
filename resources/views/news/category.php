<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News categories</title>
</head>

<body>
    <?php
    include_once "menu.php"
    ?>

    <h1><?= $category['name'] ?></h1>
    <?php foreach ($news as $item) : ?>
        <a href="/news/<?= $category['slug'] ?>/<?= $item['slug'] ?>"><?= $item['title'] ?></a><br>
    <?php endforeach; ?>
</body>

</html>
