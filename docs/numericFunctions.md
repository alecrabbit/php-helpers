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
