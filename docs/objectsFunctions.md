### Object functions
> namespace `AlecRabbit\Helpers`

##### callMethod()
Calls private/protected method of object
```php
$result = callMethod($object, 'protectedMethod', $arg1, $arg2);
```
```php
$result = callMethod(Some::class, 'privateMethod', $arg1, $arg2);
```
##### getValue()
Gets value of private/protected property of object
```php
$result = getValue($object, 'protectedProperty');
```
```php
$result = getValue(Some::class, 'privatedProperty');
```
