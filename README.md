# PHP Helpers

Set of useful helper functions

[![PHP Version](https://img.shields.io/packagist/php-v/alecrabbit/php-helpers.svg)](https://php.net)
[![Build Status](https://travis-ci.com/alecrabbit/php-helpers.svg?branch=master)](https://travis-ci.org/alecrabbit/php-helpers)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/alecrabbit/php-helpers/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/alecrabbit/php-helpers/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/alecrabbit/php-helpers/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/alecrabbit/php-helpers/?branch=master)
[![Total Downloads](https://poser.pugx.org/alecrabbit/php-helpers/downloads)](https://packagist.org/packages/alecrabbit/php-helpers)

[![Latest Stable Version](https://poser.pugx.org/alecrabbit/php-helpers/v/stable)](https://packagist.org/packages/alecrabbit/php-helpers)
[![Latest Stable Version](https://img.shields.io/packagist/v/alecrabbit/php-helpers.svg)](https://packagist.org/packages/alecrabbit/php-helpers)
[![Latest Unstable Version](https://poser.pugx.org/alecrabbit/php-helpers/v/unstable)](https://packagist.org/packages/alecrabbit/php-helpers)

[![License](https://poser.pugx.org/alecrabbit/php-helpers/license)](https://packagist.org/packages/alecrabbit/php-helpers)

### Installation
```bash
composer require alecrabbit/php-helpers
```

### Usage

> See [examples](https://github.com/alecrabbit/php-helpers/tree/master/examples)

##### Quick example
```php 
use function \AlecRabbit\typeOf;

echo typeOf(1); // "integer"
```


## Functions

### [Miscellaneous Functions](docs/miscFunctions.md)

- typeOf()
- swap()
- swapTo()
- inContainer()
- inRange()

### [Array functions](docs/arrayFunctions.md)

- is_homogeneous()
- formatted_array()
- array_unset_first()
- array_unset_last()

### [Numeric functions](docs/numericFunctions.md)

- is_negative()
- bounds()
- trim_zeros()

### [Object functions](docs/objectsFunctions.md)

- callMethod()
- getValue()

### [Time functions](docs/timeFunctions.md)

- now()
- carbon()
- base_timestamp()

### String functions

##### tag()
```php 
$tagged = tag('text', 'tag') // string(15) "<tag>text</tag>"
```

##### brackets()
```php 
brackets('text'); // string(6) "[text]"
brackets('text', BRACKETS_ANGLE); // string(10) "⟨text⟩"
brackets('text', BRACKETS_PARENTHESES); // string(6) "(text)"
brackets('text', BRACKETS_SQUARE); // string(6) "[text]"
brackets('text', BRACKETS_CURLY); // string(6) "{text}"
```

##### str_wrap() 
```php 
str_wrap('text', '-'); // string(6) "-text-"
str_wrap('text', '-', ''); // string(5) "-text"
str_wrap('text', '"', '"'); // string(6) ""text""
```

##### format_bytes()
```php 
format_bytes(234141) // string(8) "228.65KB"
format_bytes(2112441234141, 'mb', 4); // string(14) "2014580.9499MB"
```

##### format_time()
```php 
format_time(0.00001, UNIT_MICROSECONDS); //string(5) "10μs"
format_time(1); //string(5) "1000ms"
```

##### format_time_auto()
```php 
format_time_auto(0.00000001); // string(4) "10ns"
format_time_auto(0.00001); // string(5) "10μs"
format_time_auto(1); // string(2) "1s"
format_time_auto(1561); // string(6) "26.02m"
format_time_auto(3234561); // string(8) "898.489h"
```
