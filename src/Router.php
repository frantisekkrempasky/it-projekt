<?php
declare(strict_types=1);

namespace App;

use App\Http\Request;
use App\Http\Response;

/**
 * Router: zoznam route „relatívna adresa → controller a metóda“.
 * get() pridá route, dispatch() nájde route pre Request, vytvorí controller, zavolá metódu a vráti jej Response.
 */
final class Router
{
    /** @var array<int, array{method: string, pattern: string, handler: array{0: string, 1: string}}> */
    private array $routes = [];       // zoznam route; plní ho get()

    /** Pridá route pre HTTP metódu GET. $handler je dvojica [názov triedy, názov metódy]. */
    public function get(string $path, array $handler): void
    {
        $this->add('GET', $path, $handler);
    }

    private function add(string $method, string $path, array $handler): void
    {
        // {id} v adrese nahradí (\d+): regulárny výraz, vzor pre text. \d je číslica, + je jedna
        // alebo viac, zátvorky si číslo zapamätajú.   '/recipes/{id}' → '/recipes/(\d+)'
        // Pre '/categories' sa nič nemení.
        $pattern = preg_replace('#\{[a-z_]+\}#', '(\d+)', $path);
        $this->routes[] = [
            'method'  => $method,
            'pattern' => '#^' . $pattern . '$#',   // ^ začiatok, $ koniec: '#^/categories$#'
            'handler' => $handler,
        ];
    }

    /** Nájde route pre HTTP metódu a relatívnu adresu z Requestu a vráti Response z controllera. */
    public function dispatch(Request $request): Response
    {
        foreach ($this->routes as $route) {
            if ($route['method'] !== $request->method()) {
                continue;                                     // iná HTTP metóda → ďalšia route
            }
            // preg_match() porovná vzor route s relatívnou adresou:
            //   '#^/categories$#'     a '/categories'    → sedí,   $m = ['/categories']
            //   '#^/categories$#'     a '/categories/5'  → nesedí  ($ žiada koniec hned za categories)
            //   '#^/recipes/(\d+)$#'  a '/recipes/3'     → sedí,   $m = ['/recipes/3', '3']
            //   '#^/recipes/(\d+)$#'  a '/recipes/abc'   → nesedí  (\d+ žiada číslice)
            if (preg_match($route['pattern'], $request->path(), $m)) {
                array_shift($m);                              // zahodí celú adresu: ['3'] alebo []
                $params = array_map('intval', $m);            // text na číslo: [3] alebo []
                $class  = $route['handler'][0];               // 'App\Controller\CategoryController'
                $action = $route['handler'][1];               // 'index'
                $controller = new $class();                   // tu vzniká controller
                return $controller->$action($request, ...$params);   // = $controller->index($request)
            }
        }

        // Žiadna route nesedí (/nic): Router sám vráti stránku 404.
        return new Response(view('404', ['title' => 'Nenájdené']), 404);
    }
}
