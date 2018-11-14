# helpers

PHP helpers are set of useful functions


[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.2-8FA0BF.svg)](https://php.net/)
[![Build Status](https://travis-ci.com/alecrabbit/php-helpers.svg?branch=master)](https://travis-ci.org/alecrabbit/php-helpers)
[![Latest Stable Version](https://poser.pugx.org/alecrabbit/php-helpers/v/stable)](https://packagist.org/packages/alecrabbit/php-helpers)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/alecrabbit/php-helpers/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/alecrabbit/php-helpers/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/alecrabbit/php-helpers/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/alecrabbit/php-helpers/?branch=master)
[![Total Downloads](https://poser.pugx.org/alecrabbit/php-helpers/downloads)](https://packagist.org/packages/alecrabbit/php-helpers)
[![Latest Stable Version](https://img.shields.io/packagist/v/alecrabbit/php-helpers.svg)](https://packagist.org/packages/alecrabbit/php-helpers)
[![Latest Unstable Version](https://poser.pugx.org/alecrabbit/php-helpers/v/unstable)](https://packagist.org/packages/alecrabbit/php-helpers)
[![License](https://poser.pugx.org/alecrabbit/php-helpers/license)](https://packagist.org/packages/alecrabbit/php-helpers)


### Time functions

##### now()
```php 
$now = now(); // object(Carbon\Carbon)
```

##### base_timestamp()
```php 
// start timestamp of a period
//  "int(1514851122) => Mon Jan 01 2018 23:58:42 GMT+0000"
base_timestamp(1514851122, 86400); // "int(1514764800) => Mon Jan 01 2018 00:00:00 GMT+0000"
base_timestamp(1514851122, 3600); // "int(1514847600) => Mon Jan 01 2018 23:00:00 GMT+0000"
base_timestamp(1514851122, 60);  // "int(1514851080) => Mon Jan 01 2018 23:58:00 GMT+0000"
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

##### str_decorate()
```php 
str_decorate('text', '-'); // string(6) "-text-"
str_decorate('text', '-', ''); // string(5) "-text"
str_decorate('text', '"', '"'); // string(6) ""text""
```

##### format_bytes()
```php 
format_bytes(234141) // string(8) "228.65KB"
format_bytes(2112441234141, 'mb', 4); // string(14) "2014580.9499MB"

```

### Array functions

##### formatted_array()
```php 
formatted_array([1, 2, 3000, 4, 5, 6, 7000000, 8, 9, 1000, 11], 3);
// 1       2       3000   
// 4       5       6      
// 7000000 8       9      
// 1000    11 

$a = ['a', 'b', 'c', 'd', 'e', 'f',];
$ab =
    formatted_array($a, 3,
        function (&$value, $key) {
            $value = $key . ' ' . brackets($value);
        }
    );
// 0 [a] 1 [b] 2 [c]
// 3 [d] 4 [e] 5 [f]
```

##### unset_first()
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

##### array_key_first() / array_key_last()
```php 
$a = array (
       0 => 1,
       1 => 2,
       2 => 3,
       3 => 4,
     );
array_key_first($a); // int(0)
array_key_last($a); // int(3)
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

##### bc_bounds()
```php 
bc_bounds('1.1241243236', '1.1241243235', '1.1245535354', 10); // string(12) "1.1241243236"
```

##### trim_zeros()
```php 
trim_zeros('23.22342340000'); // string(10) "23.2234234"
trim_zeros(23.000000000); // string(2) "23"
```
