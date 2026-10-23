<p>Dáta úspešne načítané z databázy:</p>

<?php if (!empty($bicycles)): ?>
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: left;">
        <tr style="background-color: #f2f2f2;">
            <?php foreach (array_keys($bicycles[0]) as $column): ?>
                <th><?= htmlspecialchars(ucfirst($column)) ?></th>
            <?php endforeach; ?>
        </tr>
        <?php foreach ($bicycles as $row): ?>
            <tr>
                <?php foreach ($row as $value): ?>
                    <td><?= htmlspecialchars((string)$value) ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>V databáze nie sú zatiaľ žiadne bicykle.</p>
<?php endif; ?>
