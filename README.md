# Prefecture in the Boatrace Venture Project

[![Build Status](https://github.com/BoatraceVentureProject/Prefecture/workflows/Tests/badge.svg)](https://github.com/BoatraceVentureProject/Prefecture/actions?query=workflow%3Atests)
[![codecov](https://codecov.io/gh/BoatraceVentureProject/Prefecture/graph/badge.svg?token=COKGMRB92M)](https://codecov.io/gh/BoatraceVentureProject/Prefecture)
[![Latest Stable Version](https://poser.pugx.org/bvp/prefecture/v/stable)](https://packagist.org/packages/bvp/prefecture)
[![Latest Unstable Version](https://poser.pugx.org/bvp/prefecture/v/unstable)](https://packagist.org/packages/bvp/prefecture)
[![License](https://poser.pugx.org/bvp/prefecture/license)](https://packagist.org/packages/bvp/prefecture)

## Installation
```bash
composer require bvp/prefecture
```

## Usage
```php
<?php

require __DIR__ . '/vendor/autoload.php';

use Boatrace\Venture\Project\Prefecture;

$collection = Prefecture::byId(13);
var_dump($collection->get('id')); // int(13)
var_dump($collection->get('name')); // string(9) "東京都"
var_dump($collection->get('short_name')); // string(6) "東京"
var_dump($collection->get('hiragana_name')); // string(18) "とうきょうと"
var_dump($collection->get('katakana_name')); // string(18) "トウキョウト"
var_dump($collection->get('english_name')); // string(5) "tokyo"

$collection = Prefecture::byName('東京都');
var_dump($collection->get('id')); // int(13)
var_dump($collection->get('name')); // string(9) "東京都"
var_dump($collection->get('short_name')); // string(6) "東京"
var_dump($collection->get('hiragana_name')); // string(18) "とうきょうと"
var_dump($collection->get('katakana_name')); // string(18) "トウキョウト"
var_dump($collection->get('english_name')); // string(5) "tokyo"

$collection = Prefecture::byShortName('東京');
var_dump($collection->get('id')); // int(13)
var_dump($collection->get('name')); // string(9) "東京都"
var_dump($collection->get('short_name')); // string(6) "東京"
var_dump($collection->get('hiragana_name')); // string(18) "とうきょうと"
var_dump($collection->get('katakana_name')); // string(18) "トウキョウト"
var_dump($collection->get('english_name')); // string(5) "tokyo"

$collection = Prefecture::byHiraganaName('とうきょうと');
var_dump($collection->get('id')); // int(13)
var_dump($collection->get('name')); // string(9) "東京都"
var_dump($collection->get('short_name')); // string(6) "東京"
var_dump($collection->get('hiragana_name')); // string(18) "とうきょうと"
var_dump($collection->get('katakana_name')); // string(18) "トウキョウト"
var_dump($collection->get('english_name')); // string(5) "tokyo"

$collection = Prefecture::byKatakanaName('トウキョウト');
var_dump($collection->get('id')); // int(13)
var_dump($collection->get('name')); // string(9) "東京都"
var_dump($collection->get('short_name')); // string(6) "東京"
var_dump($collection->get('hiragana_name')); // string(18) "とうきょうと"
var_dump($collection->get('katakana_name')); // string(18) "トウキョウト"
var_dump($collection->get('english_name')); // string(5) "tokyo"

$collection = Prefecture::byEnglishName('tokyo');
var_dump($collection->get('id')); // int(13)
var_dump($collection->get('name')); // string(9) "東京都"
var_dump($collection->get('short_name')); // string(6) "東京"
var_dump($collection->get('hiragana_name')); // string(18) "とうきょうと"
var_dump($collection->get('katakana_name')); // string(18) "トウキョウト"
var_dump($collection->get('english_name')); // string(5) "tokyo"
```

## License
Prefecture in the Boatrace Venture Project is open source software licensed under the [MIT license](LICENSE).
