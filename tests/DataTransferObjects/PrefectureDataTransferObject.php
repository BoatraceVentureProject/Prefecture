<?php

declare(strict_types=1);

namespace Boatrace\Venture\Project\Tests\DataTransferObjects;

/**
 * @author shimomo
 */
class PrefectureDataTransferObject
{
    /**
     * @param  int     $id
     * @param  string  $name
     * @param  string  $shortName
     * @param  string  $hiraganaName
     * @param  string  $katakanaName
     * @param  string  $englishName
     * @return void
     */
    public function __construct(
        public int $id,
        public string $name,
        public string $shortName,
        public string $hiraganaName,
        public string $katakanaName,
        public string $englishName
    ){}
}
