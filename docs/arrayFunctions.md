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
