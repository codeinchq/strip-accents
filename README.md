# Strip accents 
This PHP 7 library removes accent from strings. It is based on the sample code [published here](http://www.infowebmaster.fr/tutoriel/php-enlever-accents).  


## Usage 
```php
<?php
use CodeInc\StripAccents\StripAccents;

echo StripAccents::strip("C'est une super chaîne de caractères avec beaucoup d'accents");
// echoes: C'est une super chaine de caracteres avec beaucoup d'accents

echo StripAccents::strip("ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ");
// echoes: AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy

echo StripAccents::stripNonPrint("ABC ÀÈÝ 是我这");
// echoes: ABC AEY ---

// You can specify any encoding supported by htmlentities() as a second parameter
echo StripAccents::strip("A strïng with àccénts", "iso-8859-1");
```


## Installation
This library is available through [Packagist](https://packagist.org/packages/codeinc/strip-accents) and can be installed using [Composer](https://getcomposer.org/): 

```bash
composer require codeinc/strip-accents
```


## License
This library is published under the MIT license (see the [LICENSE](LICENSE) file). 

