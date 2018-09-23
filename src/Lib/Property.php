<?php

namespace pointybeard\PropertyBag\Lib;

class Property {

    protected $name;
    protected $value;

    public function __construct($name, $value) {
        $this->name = $name; // String
        $this->value = $value; // Mixed. Could be another property bag
    }

    public function __set($name, $value) {
        if($name != 'value') {
            throw new Exceptions\NoSuchPropertyException("No such property '{$name}'");
        }

        $this->value = $value;
        return true;
    }

    public function __get($name) {
        if(!in_array($name, ['name', 'value'])) {
            throw new Exceptions\NoSuchPropertyException("No such property '{$name}'");
        }

        return $this->$name;
    }

    public function __toString() {
        if($this->value instanceof PropertyBag) {
            // @todo: handle a property that contains a PropertyBag
            $result = "";
        } else {
            $result = $this->value;
        }

        return (string)$result;
    }
}
