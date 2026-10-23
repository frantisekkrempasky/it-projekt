<?php
// Kontrolná stránka z cv02. Konfigurácia, autoload a HTML rám sú teraz v index.php a views/layout.php.
use App\Database;

$pdo = Database::getInstance();

// 1. Tabuľky, ktoré sú v databáze (po spustení schema.sql).
$tables = $pdo->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN);

// 2. Tvoje modely – jeden riadok pre každú triedu:
$models = [
    new \App\Model\AccessoryModel(),
    new \App\Model\BicycleModel(),
    new \App\Model\LocationModel(),
    new \App\Model\StatusModel(),
    new \App\Model\TypeModel(),
];
?>
<h2>Tabuľky v databáze (<?= count($tables) ?>)</h2>
<ul>
    <?php foreach ($tables as $t): ?>
        <li><?= e($t) ?></li>
    <?php endforeach; ?>
</ul>

<h2>Modely (<?= count($models) ?>)</h2>
<?php foreach ($models as $model): ?>
    <h3><?= e($model->describe()) ?> – <?= $model->getCount() ?> záznamov</h3>
    <?php $rows = array_slice($model->getAll(), 0, 5); ?>
    <?php if ($rows): ?>
        <table>
            <tr><?php foreach (array_keys($rows[0]) as $col): ?><th><?= e($col) ?></th><?php endforeach; ?></tr>
            <?php foreach ($rows as $row): ?>
                <tr><?php foreach ($row as $v): ?><td><?= e((string) $v) ?></td><?php endforeach; ?></tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Tabuľka je prázdna – spusti seed.sql.</p>
    <?php endif; ?>
<?php endforeach; ?>
