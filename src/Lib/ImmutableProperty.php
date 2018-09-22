<?php

namespace pointybeard\PropertyBag\Lib;

class ImmutableProperty extends Property {
    public function __set($name, $value) {
        throw new Exceptions\AttemptToChangeImmutablePropertyException(
            "This is an immutable property class. Cannot change values once they are set."
        );
    }
}
