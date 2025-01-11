<?php

declare(strict_types=1);

namespace Boatrace\Venture\Project\Tests;

use Boatrace\Venture\Project\Prefecture;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;

/**
 * @author shimomo
 */
class PrefectureTest extends PHPUnitTestCase
{
    /**
     * @var \Illuminate\Support\Collection
     */
    protected Collection $collection;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->collection ??= collect(require __DIR__ . '/../config/prefectures.php');
    }

    /**
     * @return void
     */
    public function testNull(): void
    {
        $this->assertNull(Prefecture::null());
    }

    /**
     * @return void
     */
    public function testById(): void
    {
        foreach ($this->collection->pluck('id') as $index => $prefectureId) {
            $this->assertTrue(Prefecture::byId($prefectureId)->diff(
                $this->collection->get($index)
            )->isEmpty());
        }
    }

    /**
     * @return void
     */
    public function testByName(): void
    {
        foreach ($this->collection->pluck('name') as $index => $prefectureName) {
            $this->assertTrue(Prefecture::byName($prefectureName)->diff(
                $this->collection->get($index)
            )->isEmpty());
        }
    }

    /**
     * @return void
     */
    public function testByShortName(): void
    {
        foreach ($this->collection->pluck('short_name') as $index => $prefectureShortName) {
            $this->assertTrue(Prefecture::byShortName($prefectureShortName)->diff(
                $this->collection->get($index)
            )->isEmpty());
        }
    }

    /**
     * @return void
     */
    public function testByHiraganaName(): void
    {
        foreach ($this->collection->pluck('hiragana_name') as $index => $prefectureHiraganaName) {
            $this->assertTrue(Prefecture::byHiraganaName($prefectureHiraganaName)->diff(
                $this->collection->get($index)
            )->isEmpty());
        }
    }

    /**
     * @return void
     */
    public function testByKatakanaName(): void
    {
        foreach ($this->collection->pluck('katakana_name') as $index => $prefectureKatakanaName) {
            $this->assertTrue(Prefecture::byKatakanaName($prefectureKatakanaName)->diff(
                $this->collection->get($index)
            )->isEmpty());
        }
    }

    /**
     * @return void
     */
    public function testByEnglishName(): void
    {
        foreach ($this->collection->pluck('english_name') as $index => $prefectureEnglishName) {
            $this->assertTrue(Prefecture::byEnglishName($prefectureEnglishName)->diff(
                $this->collection->get($index)
            )->isEmpty());
        }
    }
}
