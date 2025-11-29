<?php

namespace App\helpers;

class Paginator {
    public int $page;
    public int $perPage;
    public int $offset;

    public function __construct(int $page, int $perPage) {
        $this->page = max(1, $page);
        $this->perPage = $perPage;
        $this->offset = ($this->page - 1) * $this->perPage;
    }
}