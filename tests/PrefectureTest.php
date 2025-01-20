<?php

declare(strict_types=1);

namespace Boatrace\Venture\Project\Tests;

use Boatrace\Venture\Project\Prefecture;
use Illuminate\Support\Collection;

/**
 * @author shimomo
 */
class PrefectureTest extends BaseTestCase
{
    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
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
        $this->assertPrefecture(
            $this->prefecturesDTO->get(13),
            Prefecture::byId(13)
        );

        $this->assertPrefecture(
            $this->prefecturesDTO->get(13),
            Prefecture::byId(13, 34)
        );

        $this->assertNull(Prefecture::byId());
        $this->assertNull(Prefecture::byId(48));
    }

    /**
     * @return void
     */
    public function testByName(): void
    {
        $this->assertPrefecture(
            $this->prefecturesDTO->get(13),
            Prefecture::byName('東京都')
        );

        $this->assertPrefecture(
            $this->prefecturesDTO->get(13),
            Prefecture::byName('東京')
        );

        $this->assertPrefecture(
            $this->prefecturesDTO->get(13),
            Prefecture::byName('東')
        );

        $this->assertNull(Prefecture::byName());
        $this->assertNull(Prefecture::byName('都道府県'));
    }

    /**
     * @return void
     */
    public function testByShortName(): void
    {
        $this->assertPrefecture(
            $this->prefecturesDTO->get(13),
            Prefecture::byShortName('東京')
        );

        $this->assertPrefecture(
            $this->prefecturesDTO->get(13),
            Prefecture::byShortName('東')
        );

        $this->assertNull(Prefecture::byShortName());
        $this->assertNull(Prefecture::byShortName('東京都'));
        $this->assertNull(Prefecture::byShortName('都道府県'));
    }

    /**
     * @return void
     */
    public function testByHiraganaName(): void
    {
        $this->assertPrefecture(
            $this->prefecturesDTO->get(13),
            Prefecture::byHiraganaName('とうきょうと')
        );

        $this->assertPrefecture(
            $this->prefecturesDTO->get(13),
            Prefecture::byHiraganaName('とうきょう')
        );

        $this->assertPrefecture(
            $this->prefecturesDTO->get(13),
            Prefecture::byHiraganaName('とう')
        );

        $this->assertNull(Prefecture::byHiraganaName());
        $this->assertNull(Prefecture::byHiraganaName('とどうふけん'));
    }

    /**
     * @return void
     */
    public function testByKatakanaName(): void
    {
        $this->assertPrefecture(
            $this->prefecturesDTO->get(13),
            Prefecture::byKatakanaName('トウキョウト')
        );

        $this->assertPrefecture(
            $this->prefecturesDTO->get(13),
            Prefecture::byKatakanaName('トウキョウ')
        );

        $this->assertPrefecture(
            $this->prefecturesDTO->get(13),
            Prefecture::byKatakanaName('トウ')
        );

        $this->assertNull(Prefecture::byKatakanaName());
        $this->assertNull(Prefecture::byKatakanaName('トドウフケン'));
    }

    /**
     * @return void
     */
    public function testByEnglishName(): void
    {
        $this->assertPrefecture(
            $this->prefecturesDTO->get(13),
            Prefecture::byEnglishName('tokyo')
        );

        $this->assertNull(Prefecture::byEnglishName());
        $this->assertNull(Prefecture::byEnglishName('prefecture'));
    }

    /**
     * @return void
     */
    public function testAllById(): void
    {
        $collection = Prefecture::allById(13);
        $this->assertSame(1, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 13);

        $collection = Prefecture::allById([13]);
        $this->assertSame(1, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 13);

        $collection = Prefecture::allById(13, 34);
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 13);
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 34);

        $collection = Prefecture::allById([13, 34]);
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 13);
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 34);

        $collection = Prefecture::allById(13, 34, 48);
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 13);
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 34);

        $collection = Prefecture::allById([13, 34, 48]);
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 13);
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 34);

        $this->assertNull(Prefecture::allById());
        $this->assertNull(Prefecture::allById([]));
        $this->assertNull(Prefecture::allById(48));
        $this->assertNull(Prefecture::allById([48]));
    }

    /**
     * @return void
     */
    public function testAllByName(): void
    {
        $collection = Prefecture::allByName('東京都');
        $this->assertSame(1, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京都');

        $collection = Prefecture::allByName(['東京都']);
        $this->assertSame(1, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京都');

        $collection = Prefecture::allByName('東京');
        $this->assertSame(1, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京都');

        $collection = Prefecture::allByName(['東京']);
        $this->assertSame(1, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京都');

        $collection = Prefecture::allByName('東京都', '広島県');
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京都');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, '広島県');

        $collection = Prefecture::allByName(['東京都', '広島県']);
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京都');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, '広島県');

        $collection = Prefecture::allByName('東', '広');
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京都');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, '広島県');

        $collection = Prefecture::allByName(['東', '広']);
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京都');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, '広島県');

        $collection = Prefecture::allByName('東京都', '広島県', '都道府県');
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京都');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, '広島県');

        $collection = Prefecture::allByName(['東京都', '広島県', '都道府県']);
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京都');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, '広島県');

        $collection = Prefecture::allByName('京', '島', '都道府県');
        $this->assertSame(7, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京都');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, '広島県');

        $collection = Prefecture::allByName(['京', '島', '都道府県']);
        $this->assertSame(7, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京都');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, '広島県');

        $this->assertNull(Prefecture::allByName());
        $this->assertNull(Prefecture::allByName([]));
        $this->assertNull(Prefecture::allByName('都道府県'));
        $this->assertNull(Prefecture::allByName(['都道府県']));
    }

    /**
     * @return void
     */
    public function testAllByShortName(): void
    {
        $collection = Prefecture::allByShortName('東京');
        $this->assertSame(1, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京');

        $collection = Prefecture::allByShortName(['東京']);
        $this->assertSame(1, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京');

        $collection = Prefecture::allByShortName('東');
        $this->assertSame(1, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京');

        $collection = Prefecture::allByShortName(['東']);
        $this->assertSame(1, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京');

        $collection = Prefecture::allByShortName('東京', '広島');
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, '広島');

        $collection = Prefecture::allByShortName(['東京', '広島']);
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, '広島');

        $collection = Prefecture::allByShortName('京', '島');
        $this->assertSame(7, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, '広島');

        $collection = Prefecture::allByShortName(['京', '島']);
        $this->assertSame(7, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, '広島');

        $collection = Prefecture::allByShortName('東京', '広島', '都道府県');
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, '広島');

        $collection = Prefecture::allByShortName(['東京', '広島', '都道府県']);
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, '広島');

        $collection = Prefecture::allByShortName('都', '県', '都道府県');
        $this->assertSame(1, $collection->count());
        $this->assertNull($collection->get('東京'));
        $this->assertNull($collection->get('広島'));

        $collection = Prefecture::allByShortName(['都', '県', '都道府県']);
        $this->assertSame(1, $collection->count());
        $this->assertNull($collection->get('東京'));
        $this->assertNull($collection->get('広島'));

        $this->assertNull(Prefecture::allByShortName());
        $this->assertNull(Prefecture::allByShortName([]));
        $this->assertNull(Prefecture::allByShortName('都道府県'));
        $this->assertNull(Prefecture::allByShortName(['都道府県']));
    }

    /**
     * @return void
     */
    public function testAllByHiraganaName(): void
    {
        $collection = Prefecture::allByHiraganaName('とうきょうと');
        $this->assertSame(1, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'とうきょうと');

        $collection = Prefecture::allByHiraganaName(['とうきょうと']);
        $this->assertSame(1, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'とうきょうと');

        $collection = Prefecture::allByHiraganaName('とう');
        $this->assertSame(1, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'とうきょうと');

        $collection = Prefecture::allByHiraganaName(['とう']);
        $this->assertSame(1, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'とうきょうと');

        $collection = Prefecture::allByHiraganaName('とうきょうと', 'ひろしまけん');
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'とうきょうと');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'ひろしまけん');

        $collection = Prefecture::allByHiraganaName(['とうきょうと', 'ひろしまけん']);
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'とうきょうと');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'ひろしまけん');

        $collection = Prefecture::allByHiraganaName('きょう', 'しま');
        $this->assertSame(7, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'とうきょうと');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'ひろしまけん');

        $collection = Prefecture::allByHiraganaName(['きょう', 'しま']);
        $this->assertSame(7, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'とうきょうと');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'ひろしまけん');

        $collection = Prefecture::allByHiraganaName('とうきょうと', 'ひろしまけん', 'とどうふけん');
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'とうきょうと');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'ひろしまけん');

        $collection = Prefecture::allByHiraganaName(['とうきょうと', 'ひろしまけん', 'とどうふけん']);
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'とうきょうと');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'ひろしまけん');

        $collection = Prefecture::allByHiraganaName('と', 'けん', 'とどうふけん');
        $this->assertSame(45, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'とうきょうと');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'ひろしまけん');

        $collection = Prefecture::allByHiraganaName(['と', 'けん', 'とどうふけん']);
        $this->assertSame(45, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'とうきょうと');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'ひろしまけん');

        $this->assertNull(Prefecture::allByHiraganaName());
        $this->assertNull(Prefecture::allByHiraganaName([]));
        $this->assertNull(Prefecture::allByHiraganaName('とどうふけん'));
        $this->assertNull(Prefecture::allByHiraganaName(['とどうふけん']));
    }

    /**
     * @return void
     */
    public function testAllByKatakanaName(): void
    {
        $collection = Prefecture::allByKatakanaName('トウキョウト');
        $this->assertSame(1, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'トウキョウト');

        $collection = Prefecture::allByKatakanaName(['トウキョウト']);
        $this->assertSame(1, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'トウキョウト');

        $collection = Prefecture::allByKatakanaName('トウ');
        $this->assertSame(1, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'トウキョウト');

        $collection = Prefecture::allByKatakanaName(['トウ']);
        $this->assertSame(1, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'トウキョウト');

        $collection = Prefecture::allByKatakanaName('トウキョウト', 'ヒロシマケン');
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'トウキョウト');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'ヒロシマケン');

        $collection = Prefecture::allByKatakanaName(['トウキョウト', 'ヒロシマケン']);
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'トウキョウト');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'ヒロシマケン');

        $collection = Prefecture::allByKatakanaName('キョウ', 'シマ');
        $this->assertSame(7, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'トウキョウト');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'ヒロシマケン');

        $collection = Prefecture::allByKatakanaName(['キョウ', 'シマ']);
        $this->assertSame(7, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'トウキョウト');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'ヒロシマケン');

        $collection = Prefecture::allByKatakanaName('トウキョウト', 'ヒロシマケン', 'トドウフケン');
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'トウキョウト');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'ヒロシマケン');

        $collection = Prefecture::allByKatakanaName(['トウキョウト', 'ヒロシマケン', 'トドウフケン']);
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'トウキョウト');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'ヒロシマケン');

        $collection = Prefecture::allByKatakanaName('ト', 'ケン', 'トドウフケン');
        $this->assertSame(45, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'トウキョウト');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'ヒロシマケン');

        $collection = Prefecture::allByKatakanaName(['ト', 'ケン', 'トドウフケン']);
        $this->assertSame(45, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'トウキョウト');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'ヒロシマケン');

        $this->assertNull(Prefecture::allByKatakanaName());
        $this->assertNull(Prefecture::allByKatakanaName([]));
        $this->assertNull(Prefecture::allByKatakanaName('トドウフケン'));
        $this->assertNull(Prefecture::allByKatakanaName(['トドウフケン']));
    }

    /**
     * @return void
     */
    public function testAllByEnglishName(): void
    {
        $collection = Prefecture::allByEnglishName('tokyo');
        $this->assertSame(1, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'tokyo');

        $collection = Prefecture::allByEnglishName(['tokyo']);
        $this->assertSame(1, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'tokyo');

        $collection = Prefecture::allByEnglishName('to');
        $this->assertSame(7, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'tokyo');

        $collection = Prefecture::allByEnglishName(['to']);
        $this->assertSame(7, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'tokyo');

        $collection = Prefecture::allByEnglishName('tokyo', 'hiroshima');
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'tokyo');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'hiroshima');

        $collection = Prefecture::allByEnglishName(['tokyo', 'hiroshima']);
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'tokyo');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'hiroshima');

        $collection = Prefecture::allByEnglishName('kyo', 'shima');
        $this->assertSame(7, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'tokyo');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'hiroshima');

        $collection = Prefecture::allByEnglishName(['kyo', 'shima']);
        $this->assertSame(7, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'tokyo');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'hiroshima');

        $collection = Prefecture::allByEnglishName('tokyo', 'hiroshima', 'prefecture');
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'tokyo');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'hiroshima');

        $collection = Prefecture::allByEnglishName(['tokyo', 'hiroshima', 'prefecture']);
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'tokyo');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'hiroshima');

        $collection = Prefecture::allByEnglishName('to', 'ken', 'prefecture');
        $this->assertSame(7, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'tokyo');
        $this->assertNull(Prefecture::get('hiroshima'));

        $collection = Prefecture::allByEnglishName(['to', 'ken', 'prefecture']);
        $this->assertSame(7, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'tokyo');
        $this->assertNull(Prefecture::get('hiroshima'));

        $this->assertNull(Prefecture::allByEnglishName());
        $this->assertNull(Prefecture::allByEnglishName([]));
        $this->assertNull(Prefecture::allByEnglishName('prefecture'));
        $this->assertNull(Prefecture::allByEnglishName(['prefecture']));
    }
}
