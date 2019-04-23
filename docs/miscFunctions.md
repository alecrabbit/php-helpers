### Miscellaneous functions

> namespace `AlecRabbit`

##### typeOf()
Returns type of variable
```php
function typeOf(mixed $var): string
```
```php 
typeOf(new \AlecRabbit\SomeSpace\SomeClass()); // string(30) "AlecRabbit\SomeSpace\SomeClass"
typeOf(new \stdClass()); // string(8) "stdClass"
typeOf('s'); // string(6) "string"
typeOf(1); // string(7) "integer"
typeOf(1.00); // string(6) "float"
```
> Note: it returns `float` instead of `double`

> namespace `AlecRabbit\Helpers`

##### swap()
Swap variables values
```php
function swap(&$var1, &$var2): void
```
##### swapTo()
##### inContainer()
##### inRange()
