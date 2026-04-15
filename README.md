# Strip Accents

[![Packagist Version](https://img.shields.io/packagist/v/codeinc/strip-accents)](https://packagist.org/packages/codeinc/strip-accents)
[![Packagist Downloads](https://img.shields.io/packagist/dt/codeinc/strip-accents)](https://packagist.org/packages/codeinc/strip-accents)
[![PHP Version](https://img.shields.io/packagist/dependency-v/codeinc/strip-accents/php)](https://packagist.org/packages/codeinc/strip-accents)
[![License](https://img.shields.io/packagist/l/codeinc/strip-accents)](LICENSE)

A PHP library to remove accents and diacritics from strings.

## Installation

```bash
composer require codeinc/strip-accents
```

Requires PHP 8.1 or later with the `mbstring` extension.

## Usage

### Strip accents

```php
use CodeInc\StripAccents\StripAccents;

echo StripAccents::strip("C'est une super chaîne de caractères avec beaucoup d'accents");
// "C'est une super chaine de caracteres avec beaucoup d'accents"

echo StripAccents::strip("ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ");
// "AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiieooooouuuuyy"
```

### Strip accents and non-printable characters

```php
use CodeInc\StripAccents\StripAccents;

echo StripAccents::stripNonPrint("ABC ÀÈÝ 是我这");
// "ABC AEY "

echo StripAccents::stripNonPrint("ABC ÀÈÝ 是我这", replaceWith: "-");
// "ABC AEY ---------" (each multibyte character is replaced per-byte)
```

### Custom encoding

Both methods accept an encoding parameter (any encoding supported by `htmlentities()`):

```php
echo StripAccents::strip("A strïng with àccénts", encoding: "iso-8859-1");
```

## License

This library is published under the MIT license (see the [LICENSE](LICENSE) file).
