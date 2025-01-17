<?php

declare(strict_types=1);

namespace Boatrace\Venture\Project\Tests;

use Boatrace\Venture\Project\MainPrefecture;
use Illuminate\Support\Collection;

/**
 * @author shimomo
 */
class MainPrefectureTest extends BaseTestCase
{
    /**
     * @var \Boatrace\Venture\Project\MainPrefecture
     */
    protected MainPrefecture $prefecture;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->prefecture ??= new MainPrefecture;
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
        $this->assertPrefecture(
            $this->prefecturesDTO->get(13),
            $this->prefecture->byId(13)
        );

        $this->assertPrefecture(
            $this->prefecturesDTO->get(13),
            $this->prefecture->byId(13, 34)
        );

        $this->assertNull($this->prefecture->byId());
        $this->assertNull($this->prefecture->byId(48));
    }

    /**
     * @return void
     */
    public function testByName(): void
    {
        $this->assertPrefecture(
            $this->prefecturesDTO->get(13),
            $this->prefecture->byName('東京都')
        );

        $this->assertPrefecture(
            $this->prefecturesDTO->get(13),
            $this->prefecture->byName('東京')
        );

        $this->assertPrefecture(
            $this->prefecturesDTO->get(13),
            $this->prefecture->byName('東')
        );

        $this->assertNull($this->prefecture->byName());
        $this->assertNull($this->prefecture->byName('都道府県'));
    }

    /**
     * @return void
     */
    public function testByShortName(): void
    {
        $this->assertPrefecture(
            $this->prefecturesDTO->get(13),
            $this->prefecture->byShortName('東京')
        );

        $this->assertPrefecture(
            $this->prefecturesDTO->get(13),
            $this->prefecture->byShortName('東')
        );

        $this->assertNull($this->prefecture->byShortName());
        $this->assertNull($this->prefecture->byShortName('東京都'));
        $this->assertNull($this->prefecture->byShortName('都道府県'));
    }

    /**
     * @return void
     */
    public function testByHiraganaName(): void
    {
        $this->assertPrefecture(
            $this->prefecturesDTO->get(13),
            $this->prefecture->byHiraganaName('とうきょうと')
        );

        $this->assertPrefecture(
            $this->prefecturesDTO->get(13),
            $this->prefecture->byHiraganaName('とうきょう')
        );

        $this->assertPrefecture(
            $this->prefecturesDTO->get(13),
            $this->prefecture->byHiraganaName('とう')
        );

        $this->assertNull($this->prefecture->byHiraganaName());
        $this->assertNull($this->prefecture->byHiraganaName('とどうふけん'));
    }

    /**
     * @return void
     */
    public function testByKatakanaName(): void
    {
        $this->assertPrefecture(
            $this->prefecturesDTO->get(13),
            $this->prefecture->byKatakanaName('トウキョウト')
        );

        $this->assertPrefecture(
            $this->prefecturesDTO->get(13),
            $this->prefecture->byKatakanaName('トウキョウ')
        );

        $this->assertPrefecture(
            $this->prefecturesDTO->get(13),
            $this->prefecture->byKatakanaName('トウ')
        );

        $this->assertNull($this->prefecture->byKatakanaName());
        $this->assertNull($this->prefecture->byKatakanaName('トドウフケン'));
    }

    /**
     * @return void
     */
    public function testByEnglishName(): void
    {
        $this->assertPrefecture(
            $this->prefecturesDTO->get(13),
            $this->prefecture->byEnglishName('tokyo')
        );

        $this->assertNull($this->prefecture->byEnglishName());
        $this->assertNull($this->prefecture->byEnglishName('prefecture'));
    }

    /**
     * @return void
     */
    public function testAllById(): void
    {
        $collection = $this->prefecture->allById(13);
        $this->assertSame(1, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 13);

        $collection = $this->prefecture->allById([13]);
        $this->assertSame(1, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 13);

        $collection = $this->prefecture->allById(13, 34);
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 13);
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 34);

        $collection = $this->prefecture->allById([13, 34]);
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 13);
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 34);

        $collection = $this->prefecture->allById(13, 34, 48);
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 13);
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 34);

        $collection = $this->prefecture->allById([13, 34, 48]);
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 13);
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 34);

        $this->assertNull($this->prefecture->allById());
        $this->assertNull($this->prefecture->allById([]));
        $this->assertNull($this->prefecture->allById(48));
        $this->assertNull($this->prefecture->allById([48]));
    }

    /**
     * @return void
     */
    public function testAllByName(): void
    {
        $collection = $this->prefecture->allByName('東京都');
        $this->assertSame(1, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京都');

        $collection = $this->prefecture->allByName(['東京都']);
        $this->assertSame(1, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京都');

        $collection = $this->prefecture->allByName('東京');
        $this->assertSame(1, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京都');

        $collection = $this->prefecture->allByName(['東京']);
        $this->assertSame(1, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京都');

        $collection = $this->prefecture->allByName('東京都', '広島県');
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京都');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, '広島県');

        $collection = $this->prefecture->allByName(['東京都', '広島県']);
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京都');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, '広島県');

        $collection = $this->prefecture->allByName('東', '広');
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京都');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, '広島県');

        $collection = $this->prefecture->allByName(['東', '広']);
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京都');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, '広島県');

        $collection = $this->prefecture->allByName('東京都', '広島県', '都道府県');
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京都');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, '広島県');

        $collection = $this->prefecture->allByName(['東京都', '広島県', '都道府県']);
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京都');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, '広島県');

        $collection = $this->prefecture->allByName('京', '島', '都道府県');
        $this->assertSame(7, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京都');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, '広島県');

        $collection = $this->prefecture->allByName(['京', '島', '都道府県']);
        $this->assertSame(7, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京都');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, '広島県');

        $this->assertNull($this->prefecture->allByName());
        $this->assertNull($this->prefecture->allByName([]));
        $this->assertNull($this->prefecture->allByName('都道府県'));
        $this->assertNull($this->prefecture->allByName(['都道府県']));
    }

    /**
     * @return void
     */
    public function testAllByShortName(): void
    {
        $collection = $this->prefecture->allByShortName('東京');
        $this->assertSame(1, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京');

        $collection = $this->prefecture->allByShortName(['東京']);
        $this->assertSame(1, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京');

        $collection = $this->prefecture->allByShortName('東');
        $this->assertSame(1, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京');

        $collection = $this->prefecture->allByShortName(['東']);
        $this->assertSame(1, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京');

        $collection = $this->prefecture->allByShortName('東京', '広島');
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, '広島');

        $collection = $this->prefecture->allByShortName(['東京', '広島']);
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, '広島');

        $collection = $this->prefecture->allByShortName('京', '島');
        $this->assertSame(7, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, '広島');

        $collection = $this->prefecture->allByShortName(['京', '島']);
        $this->assertSame(7, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, '広島');

        $collection = $this->prefecture->allByShortName('東京', '広島', '都道府県');
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, '広島');

        $collection = $this->prefecture->allByShortName(['東京', '広島', '都道府県']);
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, '東京');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, '広島');

        $collection = $this->prefecture->allByShortName('都', '県', '都道府県');
        $this->assertSame(1, $collection->count());
        $this->assertNull($collection->get('東京'));
        $this->assertNull($collection->get('広島'));

        $collection = $this->prefecture->allByShortName(['都', '県', '都道府県']);
        $this->assertSame(1, $collection->count());
        $this->assertNull($collection->get('東京'));
        $this->assertNull($collection->get('広島'));

        $this->assertNull($this->prefecture->allByShortName());
        $this->assertNull($this->prefecture->allByShortName([]));
        $this->assertNull($this->prefecture->allByShortName('都道府県'));
        $this->assertNull($this->prefecture->allByShortName(['都道府県']));
    }

    /**
     * @return void
     */
    public function testAllByHiraganaName(): void
    {
        $collection = $this->prefecture->allByHiraganaName('とうきょうと');
        $this->assertSame(1, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'とうきょうと');

        $collection = $this->prefecture->allByHiraganaName(['とうきょうと']);
        $this->assertSame(1, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'とうきょうと');

        $collection = $this->prefecture->allByHiraganaName('とう');
        $this->assertSame(1, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'とうきょうと');

        $collection = $this->prefecture->allByHiraganaName(['とう']);
        $this->assertSame(1, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'とうきょうと');

        $collection = $this->prefecture->allByHiraganaName('とうきょうと', 'ひろしまけん');
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'とうきょうと');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'ひろしまけん');

        $collection = $this->prefecture->allByHiraganaName(['とうきょうと', 'ひろしまけん']);
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'とうきょうと');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'ひろしまけん');

        $collection = $this->prefecture->allByHiraganaName('きょう', 'しま');
        $this->assertSame(7, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'とうきょうと');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'ひろしまけん');

        $collection = $this->prefecture->allByHiraganaName(['きょう', 'しま']);
        $this->assertSame(7, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'とうきょうと');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'ひろしまけん');

        $collection = $this->prefecture->allByHiraganaName('とうきょうと', 'ひろしまけん', 'とどうふけん');
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'とうきょうと');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'ひろしまけん');

        $collection = $this->prefecture->allByHiraganaName(['とうきょうと', 'ひろしまけん', 'とどうふけん']);
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'とうきょうと');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'ひろしまけん');

        $collection = $this->prefecture->allByHiraganaName('と', 'けん', 'とどうふけん');
        $this->assertSame(45, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'とうきょうと');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'ひろしまけん');

        $collection = $this->prefecture->allByHiraganaName(['と', 'けん', 'とどうふけん']);
        $this->assertSame(45, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'とうきょうと');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'ひろしまけん');

        $this->assertNull($this->prefecture->allByHiraganaName());
        $this->assertNull($this->prefecture->allByHiraganaName([]));
        $this->assertNull($this->prefecture->allByHiraganaName('とどうふけん'));
        $this->assertNull($this->prefecture->allByHiraganaName(['とどうふけん']));
    }

    /**
     * @return void
     */
    public function testAllByKatakanaName(): void
    {
        $collection = $this->prefecture->allByKatakanaName('トウキョウト');
        $this->assertSame(1, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'トウキョウト');

        $collection = $this->prefecture->allByKatakanaName(['トウキョウト']);
        $this->assertSame(1, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'トウキョウト');

        $collection = $this->prefecture->allByKatakanaName('トウ');
        $this->assertSame(1, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'トウキョウト');

        $collection = $this->prefecture->allByKatakanaName(['トウ']);
        $this->assertSame(1, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'トウキョウト');

        $collection = $this->prefecture->allByKatakanaName('トウキョウト', 'ヒロシマケン');
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'トウキョウト');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'ヒロシマケン');

        $collection = $this->prefecture->allByKatakanaName(['トウキョウト', 'ヒロシマケン']);
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'トウキョウト');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'ヒロシマケン');

        $collection = $this->prefecture->allByKatakanaName('キョウ', 'シマ');
        $this->assertSame(7, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'トウキョウト');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'ヒロシマケン');

        $collection = $this->prefecture->allByKatakanaName(['キョウ', 'シマ']);
        $this->assertSame(7, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'トウキョウト');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'ヒロシマケン');

        $collection = $this->prefecture->allByKatakanaName('トウキョウト', 'ヒロシマケン', 'トドウフケン');
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'トウキョウト');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'ヒロシマケン');

        $collection = $this->prefecture->allByKatakanaName(['トウキョウト', 'ヒロシマケン', 'トドウフケン']);
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'トウキョウト');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'ヒロシマケン');

        $collection = $this->prefecture->allByKatakanaName('ト', 'ケン', 'トドウフケン');
        $this->assertSame(45, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'トウキョウト');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'ヒロシマケン');

        $collection = $this->prefecture->allByKatakanaName(['ト', 'ケン', 'トドウフケン']);
        $this->assertSame(45, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'トウキョウト');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'ヒロシマケン');

        $this->assertNull($this->prefecture->allByKatakanaName());
        $this->assertNull($this->prefecture->allByKatakanaName([]));
        $this->assertNull($this->prefecture->allByKatakanaName('トドウフケン'));
        $this->assertNull($this->prefecture->allByKatakanaName(['トドウフケン']));
    }

    /**
     * @return void
     */
    public function testAllByEnglishName(): void
    {
        $collection = $this->prefecture->allByEnglishName('tokyo');
        $this->assertSame(1, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'tokyo');

        $collection = $this->prefecture->allByEnglishName(['tokyo']);
        $this->assertSame(1, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'tokyo');

        $collection = $this->prefecture->allByEnglishName('to');
        $this->assertSame(7, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'tokyo');

        $collection = $this->prefecture->allByEnglishName(['to']);
        $this->assertSame(7, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'tokyo');

        $collection = $this->prefecture->allByEnglishName('tokyo', 'hiroshima');
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'tokyo');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'hiroshima');

        $collection = $this->prefecture->allByEnglishName(['tokyo', 'hiroshima']);
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'tokyo');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'hiroshima');

        $collection = $this->prefecture->allByEnglishName('kyo', 'shima');
        $this->assertSame(7, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'tokyo');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'hiroshima');

        $collection = $this->prefecture->allByEnglishName(['kyo', 'shima']);
        $this->assertSame(7, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'tokyo');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'hiroshima');

        $collection = $this->prefecture->allByEnglishName('tokyo', 'hiroshima', 'prefecture');
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'tokyo');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'hiroshima');

        $collection = $this->prefecture->allByEnglishName(['tokyo', 'hiroshima', 'prefecture']);
        $this->assertSame(2, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'tokyo');
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(34), $collection, 'hiroshima');

        $collection = $this->prefecture->allByEnglishName('to', 'ken', 'prefecture');
        $this->assertSame(7, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'tokyo');
        $this->assertNull($this->prefecture->get('hiroshima'));

        $collection = $this->prefecture->allByEnglishName(['to', 'ken', 'prefecture']);
        $this->assertSame(7, $collection->count());
        $this->assertPrefectureByKeyName($this->prefecturesDTO->get(13), $collection, 'tokyo');
        $this->assertNull($this->prefecture->get('hiroshima'));

        $this->assertNull($this->prefecture->allByEnglishName());
        $this->assertNull($this->prefecture->allByEnglishName([]));
        $this->assertNull($this->prefecture->allByEnglishName('prefecture'));
        $this->assertNull($this->prefecture->allByEnglishName(['prefecture']));
    }
}
