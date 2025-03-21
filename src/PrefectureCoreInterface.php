<?php

declare(strict_types=1);

namespace BVP\Prefecture;

use Illuminate\Support\Collection;

/**
 * @author shimomo
 */
interface PrefectureCoreInterface
{
    /**
     * @param  string  $name
     * @param  array   $arguments
     * @return \Illuminate\Support\Collection|null
     */
    public function __call(string $name, array $arguments): ?Collection;
}
