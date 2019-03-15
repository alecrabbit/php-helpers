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

All functions are in `AlecRabbit` namespace

### Usage
```php 
use function \AlecRabbit\typeOf;

echo typeOf(1); // string(7) "integer"
```
see [examples](https://github.com/alecrabbit/php-helpers/tree/master/examples)

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

### Array functions

##### is_homogeneous()
Returns `true` if all array elements are equal
```php
is_homogeneous([1, 1, 1]); // true
``` 

##### formatted_array()
Formats one-dimensional array of scalars to array of strings 
```php 
formatted_array([1, 2, 3000, 4, 5, 6, 7000000, 8, 9, 1000, 11], 3);
// array (
//     0 => '1       2       3000   ',
//     1 => '4       5       6      ',
//     2 => '7000000 8       9      ',
//     3 => '1000    11     ',
// )

$a = ['a', 'b', 'c', 'd', 'e', 'f',];
formatted_array($a, 3,
    function (&$value, $key) {
        $value = '['.$key . '] ' . $value;
    }
);
// array (
//   0 => '[0] a [1] b [2] c',
//   1 => '[3] d [4] e [5] f',
// )
```

##### array_unset_first()
```php 
$a = array (
       0 => 1,
       1 => 2,
       2 => 3,
       3 => 4,
     );
unset_first($a); 
// array (
//   1 => 2,
//   2 => 3,
//   3 => 4,
// )
```

##### array_unset_last()
```php 
$a = array (
       0 => 1,
       1 => 2,
       2 => 3,
       3 => 4,
     );
unset_first($a); 
// array (
//   0 => 1,
//   1 => 2,
//   2 => 3,
// )
```

### Numeric functions

##### is_negative()
```php 
is_negative(null); // false
is_negative(false); // true
is_negative(-1); // true
```

##### bounds()
```php 
bounds(3); // float(1)
bounds(3, -2, 2); // float(2)
```

##### trim_zeros()
```php 
trim_zeros('23.22342340000'); // string(10) "23.2234234"
trim_zeros(23.000000000); // string(2) "23"
```
