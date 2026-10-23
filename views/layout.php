<!doctype html>
<html lang="sk">

<head>
    <meta charset="utf-8">
    <title><?= e($title) ?></title>
    <style>
        body {
            font-family: system-ui, sans-serif;
            max-width: 60rem;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        nav a {
            margin-right: 1rem;
        }

        table {
            border-collapse: collapse;
            margin-bottom: 2rem;
        }

        th,
        td {
            border: 1px solid #999;
            padding: .3rem .6rem;
            text-align: left;
        }

        th {
            background: #eee;
        }

        dt {
            font-weight: bold;
            margin-top: .6rem;
        }
    </style>
</head>

<body>
    <nav>
        <a href="<?= url('/') ?>">Úvod</a>
        <a href="<?= url('/accessories') ?>">Doplnky</a>
        <a href="<?= url('/bicycles') ?>">Bicykle</a>
        <a href="<?= url('/locations') ?>">Lokality</a>
        <a href="<?= url('/statuses') ?>">Stavy</a>
        <a href="<?= url('/types') ?>">Typy</a>
        <a href="<?= url('/kontrola') ?>">Kontrola</a>
        <a href="<?= url('/debug') ?>">Debug</a>
        <a href="<?= url('/o-aplikacii') ?>">O aplikácii</a>
    </nav>
    <h1><?= e($title) ?></h1>

    <?= $content ?>

</body>

</html>
