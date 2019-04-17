# helpers

PHP helpers are set of useful functions

[![PHP Version](https://img.shields.io/packagist/php-v/alecrabbit/php-helpers.svg)](https://php.net)
[![Build Status](https://travis-ci.com/alecrabbit/php-helpers.svg?branch=master)](https://travis-ci.org/alecrabbit/php-helpers)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/alecrabbit/php-helpers/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/alecrabbit/php-helpers/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/alecrabbit/php-helpers/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/alecrabbit/php-helpers/?branch=master)
[![Total Downloads](https://poser.pugx.org/alecrabbit/php-helpers/downloads)](https://packagist.org/packages/alecrabbit/php-helpers)

[![Latest Stable Version](https://poser.pugx.org/alecrabbit/php-helpers/v/stable)](https://packagist.org/packages/alecrabbit/php-helpers)
[![Latest Stable Version](https://img.shields.io/packagist/v/alecrabbit/php-helpers.svg)](https://packagist.org/packages/alecrabbit/php-helpers)
[![Latest Unstable Version](https://poser.pugx.org/alecrabbit/php-helpers/v/unstable)](https://packagist.org/packages/alecrabbit/php-helpers)

[![License](https://poser.pugx.org/alecrabbit/php-helpers/license)](https://packagist.org/packages/alecrabbit/php-helpers)

All functions are in `AlecRabbit` namespace.
> Note: except Object Functions - `callMethod()` and `getValue()`

### Usage
```php 
use function \AlecRabbit\typeOf;

echo typeOf(1); // string(7) "integer"
```
see [examples](https://github.com/alecrabbit/php-helpers/tree/master/examples)

[Miscellaneous Functions](docs/miscFunctions.md)

### Functions

##### typeOf()
Returns type of variable
```php 
typeOf(new \AlecRabbit\SomeSpace\SomeClass()); // string(30) "AlecRabbit\SomeSpace\SomeClass"
typeOf(new \stdClass()); // string(8) "stdClass"
typeOf('s'); // string(6) "string"
typeOf(1); // string(7) "integer"
typeOf(1.00); // string(6) "float"
```
> Note: it returns `float` instead of `double`

### Object functions
> Note: namespace `AlecRabbit\Helpers`

##### callMethod()
Calls private/protected method of object
```php
callMethod($object, 'protectedMethod', $arg1, $arg2);
```
##### getValue()
Gets value of private/protected property of object
```php
getValue($object, 'protectedProperty');
```

### Time functions

##### now()
Creates Carbon object with current datetime
```php 
$now = now(); // object(Carbon\CarbonInterface)
```

##### carbon()
Creates Carbon object, has same parameters as a Carbon constructor
```php 
$c = carbon('1 month ago'); // object(Carbon\CarbonInterface)
```

##### base_timestamp()
Returns start timestamp of a period
```php 
//         int(1514851122)                              => Mon Jan 01 2018 23:58:42 GMT+0000
base_timestamp(1514851122, 86400); //  int(1514764800)  => Mon Jan 01 2018 00:00:00 GMT+0000
base_timestamp(1514851122, 3600); //   int(1514847600)  => Mon Jan 01 2018 23:00:00 GMT+0000
base_timestamp(1514851122, 60);  //    int(1514851080)  => Mon Jan 01 2018 23:58:00 GMT+0000
```

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

### [Array functions](docs/arrayFunctions.md)

- is_homogeneous()
- formatted_array()
- array_unset_first()
- array_unset_last()

### [Numeric functions](docs/numericFunctions.md)

- is_negative()
- bounds()
- trim_zeros()
