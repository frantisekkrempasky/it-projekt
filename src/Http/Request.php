<?php
declare(strict_types=1);

namespace App\Http;

/**
 * Request: požiadavka z prehliadača ako objekt. Hodnoty, ktoré Apache dal do $_SERVER a $_GET,
 * sú tu ako vlastnosti s metódami na čítanie. Vzniká raz za požiadavku, v index.php, cez fromGlobals().
 */
final class Request
{
    // Vlastnosti sú private: zapíšu sa raz v konštruktore, potom sa len čítajú metódami.
    private string $method;   // 'GET'
    private string $prefix;   // '/student/jan.novak/it/cv04'
    private string $path;     // '/categories'
    private array  $query;    // ['q' => 'tofu']

    public function __construct(string $method, string $prefix, string $path, array $query)
    {
        $this->method = $method;
        $this->prefix = $prefix;
        $this->path   = $path;
        $this->query  = $query;
    }

    /**
     * Zostaví Request z polí $_SERVER a $_GET, ktoré naplnil Apache.
     * static: metóda patrí triede, volá sa bez objektu zápisom Request::fromGlobals().
     * "::" znamená „z triedy vezmi“; pri objekte sa píše "->". Rovnako Database::getInstance().
     */
    public static function fromGlobals(): self
    {
        $prefix = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');       // '/student/jan.novak/it/cv04'
        $path   = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);   // '/student/jan.novak/it/cv04/categories'
        $path   = substr($path, strlen($prefix));                     // '/categories'
        $path   = '/' . trim($path, '/');                             // '/categories'  (pre '.../cv04/' vyjde '/')

        return new self($_SERVER['REQUEST_METHOD'], $prefix, $path, $_GET);   // objekt Request
    }

    public function method(): string
    {
        return $this->method;
    }

    public function prefix(): string
    {
        return $this->prefix;
    }

    public function path(): string
    {
        return $this->path;
    }

    /**
     * Parameter z adresy za '?'. Pre ?q=tofu je $this->query = ['q' => 'tofu'] a query('q') vráti 'tofu'.
     * Pre adresu bez '?' je $this->query = [] a query('q') vráti $default, teda ''.
     * "??" znamená: ak ľavá strana neexistuje, použi pravú.
     */
    public function query(string $key, string $default = ''): string
    {
        return (string) ($this->query[$key] ?? $default);
    }
}
