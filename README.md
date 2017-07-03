# addon_l18n_address_format

A helper class to print Localized Address from AddressValue object

## Issue

There're various format for address in the world, but concrete5 can not change the format by site locale. This package privides a helper class to print address with localized format easily.

## Usage

```php
$address = Core::make('site')->getSite()->getAttribute('address');
if (is_object($address)) {
    echo Core::make(\C5j\Localization\Service\Address\Formatter::class)->format($address);
}
```
