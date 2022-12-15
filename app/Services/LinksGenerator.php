<?php

namespace App\Services;

class LinksGenerator
{
    /**
     * Guarda os links do HATEOAS
     *
     * @var array
     */
    private array $links = [];
    
    /**
     * Adiciona um link no HATEOAS
     *
     * @param string $type
     * @param string $url
     * @param string $rel
     * @return void
     */
    private function add(string $type, string $url, string $rel): void
    {
        $this->links[] = [
            'type' => $type,
            'url' => $url,
            'rel' => $rel
        ];
    }

    /**
     * Adiciona um link do tipo GET
     *
     * @param string $url
     * @param string $rel
     * @return void
     */
    public function get(string $url, string $rel): void
    {
        $this->add('GET', $url, $rel);
    }

    /**
     * Adiciona um link do tipo POST
     *
     * @param string $url
     * @param string $rel
     * @return void
     */
    public function post(string $url, string $rel): void
    {
        $this->add('POST', $url, $rel);
    }

    /**
     * Adiciona um link do tipo PUT
     *
     * @param string $url
     * @param string $rel
     * @return void
     */
    public function put(string $url, string $rel): void
    {
        $this->add('PUT', $url, $rel);
    }

    /**
     * Adiciona um link do tipo PATCH
     *
     * @param string $url
     * @param string $rel
     * @return void
     */
    public function patch(string $url, string $rel): void
    {
        $this->add('PATCH', $url, $rel);
    }

    /**
     * Adiciona um link do tipo DELETE
     *
     * @param string $url
     * @param string $rel
     * @return void
     */
    public function delete(string $url, string $rel): void
    {
        $this->add('DELETE', $url, $rel);
    }

    /**
     * Retorna um array com os links do HATEOAS
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->links;
    }

    
}
