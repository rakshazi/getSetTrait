# GetSetTrait
A dynamic setter-getter library for PHP 5.4+.

You can use methods like `setFoo('bar')` and `getFoo()`, which you DON'T have to create (in your class).
GetSetTrait will make these methods work for you automatically as long as you have a `$foo` property in your class.

It makes use of Traits, so `using` it is super simple, you don't have to extend any class, as you can extend a single class only, we don't force you to use ours.
You can restrict to only getter only or you can specify a Type for property using **annotations**.

## Installation

GetSetTrait uses [Composer](http://getcomposer.org/) to make hassles Go.

Learn to use composer and add this to require (in your composer.json):

> "rakshazi/get-set-trait": "@stable"

Library on [Packagist](https://packagist.org/packages/rakshazi/get-set-trait).

## Usage

Just add this in your classes:

> use Rakshazi\GetSetTrait;

```php
class Dummy
{
    //Add ability to use dynamic getters and setters
    use \Rakshazi\GetSetTrait;
}

//Init dummy class
$dummy = new Dummy;
//Set new var 'message_for_world' with value
$dummy->setMessageForWorld('Hello');
//Will return "Hello\n"
echo $dummy->getMessageForWorld()."\n";
//Will return the same text
echo $dummy->getData('message_for_world')."\n";
//Set new message for our world!
$dummy->setData('message_for_world', 'Bye-bye!');
//Will return "Bye-bye!\n"
echo $dummy->getData('message_for_world')."\n";
//Will set new var 'new_message'
$dummy->setNewMessage('Use me now!');
//Will return true, value exists
$dummy->hasNewMessage();
//Will return false
$dummy->hasSomeOtherValue();
//Will show all object data
var_dump($dummy);
```

**That's basically it.**

## Advanced usage

### Data property

If you want save all data in `$object->someProperty` array instead of saving each property as object's property (`$object->property_name`),
you can use `setDataProperty('data')` function, example:

```php
<?php
class Dummy
{
    //Add ability to use dynamic getters and setters
    use \Rakshazi\GetSetTrait;

    public function __construct()
    {
        $this->setDataProperty('data');
    }
}

//Init dummy class
$dummy = new Dummy;
//Set new var 'message_for_world' with value
$dummy->setMessageForWorld('Hello');
//Will return "Hello\n"
echo $dummy->getMessageForWorld()."\n";
//Will return the same text
echo $dummy->getData('message_for_world')."\n";
//Set new message for our world!
$dummy->setData('message_for_world', 'Bye-bye!');
//Will return "Bye-bye!\n"
echo $dummy->getData('message_for_world')."\n";
//Will set new var 'new_message'
$dummy->setNewMessage('Use me now!');
//Will show all object data
var_dump($dummy);
```

**Result** (all data saved in `data` property)

```
object(Dummy)#1 (2) {
  ["_data_property":"Dummy":private]=>
  string(4) "data"
  ["data"]=>
  array(2) {
    ["message_for_world"]=>
    string(8) "Bye-bye!"
    ["new_message"]=>
    string(11) "Use me now!"
  }
}
```

