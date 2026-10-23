<?php
?>
<h2><?= e($title) ?></h2>
<?php if (!empty($row)): ?>
    <dl>
        <?php foreach ($row as $col => $val): ?>
            <dt><?= e($col) ?></dt>
            <dd><?= e((string) $val) ?></dd>
        <?php endforeach; ?>
    </dl>
<?php else: ?>
    <p>Záznam nebol nájdený.</p>
<?php endif; ?>
<p><a href="<?= url($back) ?>">Späť na zoznam</a></p>
