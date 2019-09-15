### String functions

> namespace `AlecRabbit`

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
##### boolToStr()
Returns string representation(`"true"` or `"false"`) of a bool value, `"null"` if `$value` is `NULL`
```php
function boolToStr(?bool $value): string
```

```php 
format_time_auto(0.00000001); // string(4) "10ns"
format_time_auto(0.00001); // string(5) "10μs"
format_time_auto(1); // string(2) "1s"
format_time_auto(1561); // string(6) "26.02m"
format_time_auto(3234561); // string(8) "898.489h"
```
