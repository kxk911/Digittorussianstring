# Install

`composer require kxk911/digittorussianstring`

## For Laravel 
add folow string to config/app.conf
```php
Kxk911\Digittorussianstring\DigittorussianstringServiceProvider::class
```

## Basic usage

### Simple code

```php
<?
require __DIR__ . '/vendor/autoload.php';
use Kxk911\Digittorussianstring;

print_r(Digittorussianstring\Digittorussianstring::toWord('123.1') );
```

### For Laravel
```php
use Kxk911\Digittorussianstring;

//Some code

$dd = new Digittorussianstring\Digittorussianstring;
echo $dd->toWord('123.1'));
```


Result:
```
array:2 [▼
  0 => "Сто двадцать три  "
  1 => "1"
]
```
