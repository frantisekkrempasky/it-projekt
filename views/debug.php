<?php /* Očakáva: $request (objekt App\Http\Request). */ ?>
<table>
    <!-- čo dal Apache do $_SERVER -->
    <tr><th>$_SERVER['REQUEST_METHOD']</th><td><?= e($_SERVER['REQUEST_METHOD']) ?></td></tr>
    <tr><th>$_SERVER['SCRIPT_NAME']</th>   <td><?= e($_SERVER['SCRIPT_NAME']) ?></td></tr>
    <tr><th>$_SERVER['REQUEST_URI']</th>   <td><?= e($_SERVER['REQUEST_URI']) ?></td></tr>
    <!-- čo z toho vypočítal Request -->
    <tr><th>$request->method()</th>  <td><?= e($request->method()) ?></td></tr>
    <tr><th>$request->prefix()</th>  <td><?= e($request->prefix()) ?></td></tr>
    <tr><th>$request->path()</th>    <td><?= e($request->path()) ?></td></tr>
    <tr><th>$request->query('q')</th><td><?= e($request->query('q')) ?></td></tr>
</table>
<p>Zmeň koniec adresy, napríklad na <code>/debug?q=tofu</code>, a sleduj, čo sa v tabuľke zmení.</p>
