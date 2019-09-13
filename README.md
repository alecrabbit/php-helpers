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
- inContainer()
- inRange()
- onWindows()

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

### [String functions](docs/stringFunctions.md)

- tag()
- brackets()
- str_wrap() 
- format_bytes()
- format_time()
- format_time_auto()
