<?php

declare(strict_types=1);

namespace BVP\Prefecture\Tests\PrefectureTests;

use BVP\Prefecture\Prefecture;
use BVP\Prefecture\Tests\PrefectureTestCase;

/**
 * @author shimomo
 */
final class ByTest extends PrefectureTestCase
{
    /**
     * @return void
     */
    public function testByNumber(): void
    {
        $this->assertPrefecture($this->prefecturesDTO->get(13), Prefecture::byNumber(13));
        $this->assertNull(Prefecture::byNumber(48));
    }

    /**
     * @return void
     */
    public function testByName(): void
    {
        $this->assertPrefecture($this->prefecturesDTO->get(13), Prefecture::byName('東京都'));
        $this->assertPrefecture($this->prefecturesDTO->get(13), Prefecture::byName('東京'));
        $this->assertPrefecture($this->prefecturesDTO->get(13), Prefecture::byName('東'));
        $this->assertNull(Prefecture::byName('都道府県'));
    }

    /**
     * @return void
     */
    public function testByShortName(): void
    {
        $this->assertPrefecture($this->prefecturesDTO->get(13), Prefecture::byShortName('東京'));
        $this->assertPrefecture($this->prefecturesDTO->get(13), Prefecture::byShortName('東'));
        $this->assertNull(Prefecture::byShortName('東京都'));
        $this->assertNull(Prefecture::byShortName('都道府県'));
    }

    /**
     * @return void
     */
    public function testByHiraganaName(): void
    {
        $this->assertPrefecture($this->prefecturesDTO->get(13), Prefecture::byHiraganaName('とうきょうと'));
        $this->assertPrefecture($this->prefecturesDTO->get(13), Prefecture::byHiraganaName('とうきょう'));
        $this->assertPrefecture($this->prefecturesDTO->get(13), Prefecture::byHiraganaName('とう'));
        $this->assertNull(Prefecture::byShortName('とどうふけん'));
    }

    /**
     * @return void
     */
    public function testByKatakanaName(): void
    {
        $this->assertPrefecture($this->prefecturesDTO->get(13), Prefecture::byKatakanaName('トウキョウト'));
        $this->assertPrefecture($this->prefecturesDTO->get(13), Prefecture::byKatakanaName('トウキョウ'));
        $this->assertPrefecture($this->prefecturesDTO->get(13), Prefecture::byKatakanaName('トウ'));
        $this->assertNull(Prefecture::byKatakanaName('トドウフケン'));
    }

    /**
     * @return void
     */
    public function testByEnglishName(): void
    {
        $this->assertPrefecture($this->prefecturesDTO->get(13), Prefecture::byEnglishName('tokyo'));
        $this->assertPrefecture($this->prefecturesDTO->get(9), Prefecture::byEnglishName('to'));
        $this->assertNull(Prefecture::byEnglishName('prefecture'));
    }

    /**
     * @return void
     */
    public function testByRegionNumber(): void
    {
        $this->assertPrefecture($this->prefecturesDTO->get(8), Prefecture::byRegionNumber(3));
        $this->assertNull(Prefecture::byRegionNumber(9));
    }

    /**
     * @return void
     */
    public function testByRegionName(): void
    {
        $this->assertPrefecture($this->prefecturesDTO->get(8), Prefecture::byRegionName('関東'));
        $this->assertNull(Prefecture::byRegionName('prefecture'));
    }
}
