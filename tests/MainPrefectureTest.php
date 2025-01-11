<?php

declare(strict_types=1);

namespace Boatrace\Venture\Project\Tests;

use Boatrace\Venture\Project\MainPrefecture;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;

/**
 * @author shimomo
 */
class MainPrefectureTest extends PHPUnitTestCase
{
    /**
     * @var \Boatrace\Venture\Project\MainPrefecture
     */
    protected MainPrefecture $prefecture;

    /**
     * @var \Illuminate\Support\Collection
     */
    protected Collection $collection;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->prefecture ??= new MainPrefecture;

        $this->collection ??= collect(require __DIR__ . '/../config/prefectures.php');
    }

    /**
     * @return void
     */
    public function testNull(): void
    {
        $this->assertNull($this->prefecture->null());
    }

    /**
     * @return void
     */
    public function testById(): void
    {
        foreach ($this->collection->pluck('id') as $index => $prefectureId) {
            $this->assertTrue($this->prefecture->byId($prefectureId)->diff(
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
            $this->assertTrue($this->prefecture->byName($prefectureName)->diff(
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
            $this->assertTrue($this->prefecture->byShortName($prefectureShortName)->diff(
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
            $this->assertTrue($this->prefecture->byHiraganaName($prefectureHiraganaName)->diff(
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
            $this->assertTrue($this->prefecture->byKatakanaName($prefectureKatakanaName)->diff(
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
            $this->assertTrue($this->prefecture->byEnglishName($prefectureEnglishName)->diff(
                $this->collection->get($index)
            )->isEmpty());
        }
    }
}
