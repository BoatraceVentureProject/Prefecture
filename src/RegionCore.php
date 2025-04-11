<?php

declare(strict_types=1);

namespace BVP\Prefecture;

use Shimomo\Helper\Arr;

/**
 * @author shimomo
 */
class RegionCore implements PrefectureCoreInterface
{
    /**
     * @var array
     */
    private array $prefectures;

    /**
     * @var array
     */
    private array $resolveMethodMap = [
        '/^(all)$/u' => 'all',
        '/^by(.+)List$/u' => 'byList',
        '/^by(.+)$/u' => 'by',
    ];

    /**
     * @return void
     */
    public function __construct()
    {
        $this->prefectures = require __DIR__ . '/../config/prefectures.php';
    }

    /**
     * @param  string  $name
     * @param  array   $arguments
     * @return array|null
     */
    public function __call(string $name, array $arguments): ?array
    {
        return $this->resolveMethod($name, $arguments);
    }

    /**
     * @param  string  $name
     * @param  array   $arguments
     * @return array|null
     *
     * @throws \BadMethodCallException
     */
    private function resolveMethod(string $name, array $arguments): ?array
    {
        foreach ($this->resolveMethodMap as $pattern => $method) {
            if (preg_match($pattern, $name, $matches)) {
                if (is_callable([$this, $method])) {
                    return $this->$method($matches[1], $arguments);
                }
            }
        }

        throw new \BadMethodCallException(
            __METHOD__ . "() - The specified method '{$name}' does not exist in class '" . self::class . "'."
        );
    }

    /**
     * @param  string  $name
     * @param  array   $arguments
     * @return array
     */
    private function all(string $name, array $arguments): array
    {
        return $this->arrayKeyBy($this->prefectures, 'region_number');
    }

    /**
     * @param  string  $name
     * @param  array   $arguments
     * @return array|null
     *
     * @throws \InvalidArgumentException
     */
    private function byList(string $name, array $arguments): ?array
    {
        if (($countArguments = count($arguments)) === 0) {
            throw new \InvalidArgumentException(
                __METHOD__ . "() - Too few arguments to function " . self::class . "::by{$name}(), " .
                "$countArguments passed and exactly 1 expected."
            );
        }

        $snakeCaseName = $this->snakeCase($name);
        $flattenArguments = $this->arrayFlatten($arguments);
        $exactMatchedPrefectures = Arr::whereIn($this->prefectures, $snakeCaseName, $flattenArguments);
        if (!empty($exactMatchedPrefectures)) {
            return $this->arrayKeyBy($exactMatchedPrefectures, 'number');
        }

        $partialMatchedPrefectures  = array_filter($this->prefectures, function ($prefecture, $key) use ($snakeCaseName, $flattenArguments) {
            return !empty(array_filter($flattenArguments, function ($argument) use ($snakeCaseName, $prefecture, $key) {
                return str_contains((string) $prefecture[$snakeCaseName], (string) $argument);
            }));
        }, ARRAY_FILTER_USE_BOTH);
        if (!empty($partialMatchedPrefectures)) {
            return $this->arrayKeyBy($partialMatchedPrefectures, 'number');
        }

        return null;
    }

    /**
     * @param  string  $name
     * @param  array   $arguments
     * @return array|null
     *
     * @throws \InvalidArgumentException
     */
    private function by(string $name, array $arguments): ?array
    {
        if (($countArguments = count($arguments)) !== 1) {
            $messageType = $countArguments === 0 ? 'few' : 'many';
            throw new \InvalidArgumentException(
                __METHOD__ . "() - Too {$messageType} arguments to function " . self::class . "::by{$name}(), " .
                "{$countArguments} passed and exactly 1 expected."
            );
        }

        $snakeCaseName = $this->snakeCase($name);
        $flattenArguments = $this->arrayFlatten($arguments);
        $exactMatchedPrefecture = Arr::firstWhere($this->prefectures, $snakeCaseName, $flattenArguments[0]);
        if (!is_null($exactMatchedPrefecture)) {
            return $exactMatchedPrefecture;
        }

        $partialMatchedPrefectures = array_filter($this->prefectures, function ($prefecture, $key) use ($snakeCaseName, $flattenArguments) {
            return str_contains((string) $prefecture[$snakeCaseName], (string) $flattenArguments[0]);
        }, ARRAY_FILTER_USE_BOTH);

        $partialMatchedPrefecture = reset($partialMatchedPrefectures);
        return $partialMatchedPrefecture === false ? null : $partialMatchedPrefecture;
    }

    /**
     * @param  array  $array
     * @return array
     */
    private function arrayFlatten(array $array): array
    {
        $response = [];
        array_walk_recursive($array, function ($value) use (&$response) {
            $response[] = $value;
        });

        return $response;
    }

    /**
     * @param  array   $array
     * @param  string  $key
     * @return array
     */
    private function arrayKeyBy(array $array, string $key): array
    {
        return array_combine(array_column($array, $key), $array);
    }

    /**
     * @param  string  $value
     * @return string
     */
    private function snakeCase(string $value): string
    {
        return ltrim(strtolower(preg_replace('/[A-Z]/', '_$0', $value)), '_');
    }
}
