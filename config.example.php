<?php
// Vzor konfigurácie. Skopíruj tento súbor ako config.php a doplň svoje údaje.
// config.php je v .gitignore – do repository nejde, na sigma.tuke.sk sa dostane uložením v editore.
return [
    'host'   => 'localhost',          // databáza beží na tom istom serveri ako PHP
    'dbname' => 'meno_priezvisko',    // tvoja databáza (rovnaká ako login do Adminer)
    'user'   => 'meno_priezvisko',    // login do databázy
    'pass'   => '',                   // heslo z cvičenia
    'debug'  => true,                 // true = chyby sa zobrazia v prehliadači (počas vývoja)
];
