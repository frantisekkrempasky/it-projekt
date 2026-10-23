<?php

namespace App\Controller;

use App\Http\Response;

abstract class BaseController
{
    protected function render(string $view, array $data = []): Response
    {
        extract($data);

        $viewFile = __DIR__ . '/../../views/' . $view . '.php';

        if (!file_exists($viewFile)) {
            $viewFile = __DIR__ . '/../../views/404.php';
        }

        // 1. Vygenerovanie špecifického obsahu (napr. home.php)
        ob_start();
        include $viewFile;
        $content = ob_get_clean();

        // 2. Obalenie obsahu do hlavného layoutu (ktorý obsahuje menu)
        $layoutFile = __DIR__ . '/../../views/layout.php';
        if (file_exists($layoutFile)) {
            ob_start();
            include $layoutFile;
            $finalContent = ob_get_clean();
        } else {
            $finalContent = $content;
        }

        return new Response($finalContent);
    }
}
