<?php
declare(strict_types=1);

namespace App\Http;

/**
 * Response: odpoveď pre prehliadač ako objekt: stavový kód, hlavičky, telo.
 * Controller ju vráti, index.php ju pošle metódou send().
 */
final class Response
{
    private string $body;      // HTML
    private int    $status;    // 200, 404, ...
    private array  $headers;   // ['Content-Type' => 'text/html; charset=UTF-8']

    // new Response($html) stačí pre bežnú stránku: $status je predvolene 200, hlavičky prázdne.
    public function __construct(string $body, int $status = 200, array $headers = [])
    {
        $this->body    = $body;
        $this->status  = $status;
        // "+" spojí dve polia; pri rovnakom kľúči ostane hodnota z ľavého.
        // [] + ['Content-Type' => 'text/html...']                 → ['Content-Type' => 'text/html...']
        // ['Content-Type' => 'text/plain'] + ['Content-Type' => 'text/html...'] → ['Content-Type' => 'text/plain']
        $this->headers = $headers + ['Content-Type' => 'text/html; charset=UTF-8'];
    }

    public function status(): int
    {
        return $this->status;
    }

    public function body(): string
    {
        return $this->body;
    }

    /**
     * Pošle odpoveď prehliadaču. Naša metóda; z PHP používa http_response_code(), header() a echo.
     * Volá sa raz, v poslednom riadku index.php.
     */
    public function send(): void
    {
        http_response_code($this->status);            // Apache dá číslo do prvého riadku odpovede
        foreach ($this->headers as $name => $value) {
            header($name . ': ' . $value);            // riadok 'Content-Type: text/html; charset=UTF-8'
        }
        echo $this->body;                             // telo; jediné echo v celej aplikácii
    }
}
