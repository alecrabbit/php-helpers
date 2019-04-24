### Time functions

> namespace `AlecRabbit`

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
