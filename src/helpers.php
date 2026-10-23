<?php
declare(strict_types=1);

// Tri funkcie pre pohľady. Súbor načíta vendor/autoload.php pri každej požiadavke (composer.json → "files").

/** Ošetrí text pre výpis do HTML: znaky < > & " sa zobrazia ako znaky, nie ako HTML značky. */
function e(?string $text): string
{
    return htmlspecialchars((string) $text, ENT_QUOTES, 'UTF-8');
}

/** Z relatívnej adresy vyrobí plnú cestu pre href: url('/recipes/3') → '/student/jan.novak/it/cv03/recipes/3'. */
function url(string $path): string
{
    return BASE_URL . '/' . ltrim($path, '/');
}

/** Vyrobí HTML stránky: načíta views/<name>.php, výsledok vloží do views/layout.php a vráti ako reťazec. */
function view(string $name, array $data = []): string
{
    extract($data);                                       // ['title' => 'Úvod'] → $title = 'Úvod'

    ob_start();                                           // výstup pohľadu sa ukladá, do prehliadača sa neposiela
    require __DIR__ . '/../views/' . $name . '.php';
    $content = ob_get_clean();                            // zachytený výstup ako reťazec

    ob_start();
    require __DIR__ . '/../views/layout.php';             // layout vypíše $content na svoje miesto
    return ob_get_clean();
}
