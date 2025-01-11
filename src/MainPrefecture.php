<?php

declare(strict_types=1);

namespace Boatrace\Venture\Project;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * @author shimomo
 */
class MainPrefecture
{
    /**
     * @var \Illuminate\Support\Collection
     */
    protected Collection $prefectures;

    /**
     * @return void
     */
    public function __construct()
    {
        Collection::macro('recursive', fn() => $this->map(fn($value) =>
            is_array($value) || is_object($value)
                ? collect($value)->recursive()
                : $value
        ));
    }

    /**
     * @param  string  $name
     * @param  array   $arguments
     * @return \Illuminate\Support\Collection|null
     */
    public function __call(string $name, array $arguments): ?Collection
    {
        if (! preg_match('/^by(.+)$/u', $name, $matches)) {
            return null;
        }

        if (! count($arguments)) {
            return null;
        }

        $this->prefectures ??= collect(require __DIR__ . '/../config/prefectures.php')->recursive();

        $prefectures = $this->prefectures->keyBy(Str::snake($matches[1]));
        if ($prefectures->has($arguments[0])) {
            return $prefectures->get($arguments[0]);
        }

        return $prefectures->filter(fn($item, $key) =>
            Str::contains($key, $arguments[0])
        )->last();
    }
}
