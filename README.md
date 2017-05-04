# GetSetTrait ([Next gen of GetSetGo](https://github.com/rakshazi/GetSetGoImproved))
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
//Will show all object data
var_dump($dummy);
```

**That's basically it.**
