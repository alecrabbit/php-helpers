# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).


## [Unreleased]

## [0.4.0] - 2019-0.-.. - upcoming release
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


[Unreleased]: https://github.com/alecrabbit/php-helpers/compare/0.3.1...HEAD
[0.4.0]: https://github.com/alecrabbit/php-helpers/compare/0.3.1...0.4.0
[0.3.1]: https://github.com/alecrabbit/php-helpers/compare/0.2.6...0.3.1
[0.2.6]: https://github.com/alecrabbit/php-helpers/compare/0.1.4...0.2.6
[0.1.4]: https://github.com/alecrabbit/php-helpers/compare/0.0.16...0.1.4