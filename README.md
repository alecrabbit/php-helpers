# helpers

PHP helpers are set of useful functions


[![Build Status](https://travis-ci.com/alecrabbit/php-helpers.svg?branch=master)](https://travis-ci.org/alecrabbit/helpers)
[![Latest Stable Version](https://poser.pugx.org/alecrabbit/php-helpers/v/stable)](https://packagist.org/packages/alecrabbit/php-helpers)
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
base_timestamp(1514851122); // int(1514851080)
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
brackets('text', null, '<o>', '</o>'); // string(11) "<o>text</o>"
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

