# Property Bag

- Version: v1.0.0
- Date: Sept 22 2018
- [Release notes](https://github.com/pointybeard/property-bag/blob/master/CHANGELOG.md)
- [GitHub repository](https://github.com/pointybeard/property-bag)

[![Latest Stable Version](https://poser.pugx.org/pointybeard/property-bag/version)](https://packagist.org/packages/pointybeard/property-bag) [![License](https://poser.pugx.org/pointybeard/property-bag/license)](https://packagist.org/packages/pointybeard/property-bag)

Simplifies the task of storing key/value pairs.

## Installation

Symphony Class Mapper is installed via [Composer](http://getcomposer.org/). To install, use `composer require pointybeard/property-bag` or add `"pointybeard/property-bag": "~1.0"` to your `composer.json` file.

# Usage Example

Here is a quick and dirty example of how to use this group of classes

```<?php

include "vendor/autoload.php";

use pointybeard\PropertyBag\Lib;

$p = new Lib\PropertyBag;

$p->fruit = "apple";
$p->animal = new Lib\Property("animal", "lion");
$p->clothing = new Lib\ImmutableProperty("clothing", "hat");

var_dump($p);

$p->fruit = "banana";
var_dump($p->fruit, $p->animal->value);

try{
    $p->clothing = "belt";
    var_dump($p->clothing);

} catch (Lib\Exceptions\AttemptToChangeImmutablePropertyException $ex) {
    print "Oh oh! You can't change Immutable property 'clothing'" . PHP_EOL;
}

print_r($p->toArray());

$p2 = new Lib\PropertyBag;
$p2->username = "barry";
$p2->password = "blahblah";

$p->credentials = $p2;

var_dump(
    $p->toArray(),
    $p->credentials->value->username,
    $p->credentials->value->username->value
);
```

## Support

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/pointybeard/property-bag/issues),
or better yet, fork the library and submit a pull request.

## Contributing

We encourage you to contribute to this project. Please check out the [Contributing documentation](https://github.com/pointybeard/property-bag/blob/master/CONTRIBUTING.md) for guidelines about how to get involved.

## License

"Symphony Section Class Mapper" is released under the [MIT License](http://www.opensource.org/licenses/MIT).
