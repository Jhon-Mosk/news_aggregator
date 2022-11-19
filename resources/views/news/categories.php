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

    <h1>Категории новостей</h1>
    <?php foreach ($categories as $item) : ?>
        <a href="/news/<?= $item['slug'] ?>"><?= $item['name'] ?></a><br>
    <?php endforeach; ?>
</body>

</html>
