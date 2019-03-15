# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).


## [Unreleased]

## [0.5.1] - 2019-03-15
### Added
- class `Picklock::class` 
### Fixed 
- function `trim_zeros()` behavior

## [0.5.0] - 2019-03-03
### Added
Constants representing time intervals
```php
define('AlecRabbit\Helpers\Constants\I_01MIN', 60);
define('AlecRabbit\Helpers\Constants\I_03MIN', 180);
define('AlecRabbit\Helpers\Constants\I_05MIN', 300);
define('AlecRabbit\Helpers\Constants\I_15MIN', 900);
define('AlecRabbit\Helpers\Constants\I_30MIN', 1800);
define('AlecRabbit\Helpers\Constants\I_45MIN', 2700);
define('AlecRabbit\Helpers\Constants\I_01HOUR', 3600);
define('AlecRabbit\Helpers\Constants\I_02HOUR', 7200);
define('AlecRabbit\Helpers\Constants\I_03HOUR', 10800);
define('AlecRabbit\Helpers\Constants\I_04HOUR', 14400);
define('AlecRabbit\Helpers\Constants\I_01DAY', 86400);
```
### Changed 
- function `is_homogeneous()` renamed to `array_is_homogeneous()`

### Removed
- function `bc_bounds()` 

## [0.4.2] - 2019-02-22 
### Added
- function `array_unset_last()` 

### Changed 
- function `unset_first()` renamed to `array_unset_first()`
- function `bc_bounds()` is deprecated
 
### Removed
- function `array_key_first()`
- function `array_key_last()`

## [0.3.1] - 2019-02-20
### Done
- some optimizations

### Added
- function `is_homogeneous()` to check if all values in array are (strictly ===) equal

### Deprecated
- function `array_key_first()` in favor of [`symfony/polyfill-php73`](https://github.com/symfony/polyfill-php73)
- function `array_key_last()` in favor of [`symfony/polyfill-php73`](https://github.com/symfony/polyfill-php73)

## [0.2.6] - 2019-02-11

## [0.1.4] - 2019-01-07

## 0.0.16 - 2018-11-29


[Unreleased]: https://github.com/alecrabbit/php-helpers/compare/0.5.1...HEAD
[0.5.1]: https://github.com/alecrabbit/php-helpers/compare/0.5.0...0.5.1
[0.5.0]: https://github.com/alecrabbit/php-helpers/compare/0.4.2...0.5.0
[0.4.2]: https://github.com/alecrabbit/php-helpers/compare/0.3.1...0.4.2
[0.3.1]: https://github.com/alecrabbit/php-helpers/compare/0.2.6...0.3.1
[0.2.6]: https://github.com/alecrabbit/php-helpers/compare/0.1.4...0.2.6
[0.1.4]: https://github.com/alecrabbit/php-helpers/compare/0.0.16...0.1.4