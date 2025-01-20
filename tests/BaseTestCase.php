<?php

declare(strict_types=1);

namespace Boatrace\Venture\Project\Tests;

use Boatrace\Venture\Project\Tests\DataTransferObjects\PrefectureDataTransferObject as PrefectureDTO;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;

/**
 * @author shimomo
 */
class BaseTestCase extends PHPUnitTestCase
{
    /**
     * @var \Illuminate\Support\Collection
     */
    protected Collection $prefecturesDTO;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->initializePrefecture();
    }

    /**
     * @return void
     */
    protected function initializePrefecture(): void
    {
        if (! isset($this->prefecturesDTO)) {
            $this->prefecturesDTO = collect();
            foreach (require __DIR__ . '/../config/prefectures.php' as $prefecture) {
                $this->prefecturesDTO->put($prefecture['id'], new PrefectureDTO(
                    $prefecture['id'],
                    $prefecture['name'],
                    $prefecture['short_name'],
                    $prefecture['hiragana_name'],
                    $prefecture['katakana_name'],
                    $prefecture['english_name']
                ));
            }
        }
    }

    /**
     * @param  \Boatrace\Venture\Project\Tests\DataTransferObjects\PrefectureDataTransferObject  $prefecture
     * @param  \Illuminate\Support\Collection                                                    $collection
     * @return void
     */
    protected function assertPrefecture(PrefectureDTO $prefecture, Collection $collection): void
    {
        $this->assertSame($prefecture->id, $collection->get('id'));
        $this->assertSame($prefecture->name, $collection->get('name'));
        $this->assertSame($prefecture->shortName, $collection->get('short_name'));
        $this->assertSame($prefecture->hiraganaName, $collection->get('hiragana_name'));
        $this->assertSame($prefecture->katakanaName, $collection->get('katakana_name'));
        $this->assertSame($prefecture->englishName, $collection->get('english_name'));
    }

    /**
     * @param  \Boatrace\Venture\Project\Tests\DataTransferObjects\PrefectureDataTransferObject  $prefecture
     * @param  \Illuminate\Support\Collection                                                    $collection
     * @param  string|int                                                                        $keyName
     * @return void
     */
    protected function assertPrefectureByKeyName(PrefectureDTO $prefecture, Collection $collection, string|int $keyName): void
    {
        $this->assertSame($prefecture->id, $collection->get($keyName)->get('id'));
        $this->assertSame($prefecture->name, $collection->get($keyName)->get('name'));
        $this->assertSame($prefecture->shortName, $collection->get($keyName)->get('short_name'));
        $this->assertSame($prefecture->hiraganaName, $collection->get($keyName)->get('hiragana_name'));
        $this->assertSame($prefecture->katakanaName, $collection->get($keyName)->get('katakana_name'));
        $this->assertSame($prefecture->englishName, $collection->get($keyName)->get('english_name'));
    }
}
