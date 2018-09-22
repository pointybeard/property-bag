<?php

namespace pointybeard\PropertyBag\Lib;

class PropertyBag {

    protected $properties = [];

    public function __get($name) {
        if(!isset($this->properties[$name])) {
            throw new Exceptions\NoSuchPropertyException("No such property '{$name}'");
        }
        return $this->properties[$name];
    }

    public function __set($name, $value) {
        if(!isset($this->properties[$name])) {

            $this->properties[$name] = ($value instanceof Property
                ? $value
                : new Property($name, $value)
            );

        } else {
            $this->properties[$name]->value = $value;
        }

        return true;
    }

    public function __call($name, $args)
    {
        if (empty($args)) {
            return $this->$name;
        }

        $this->$name = $args[0];
        return $this;
    }

    public function toArray() {
        $array = [];

        foreach($this->properties as $p) {
            $array[$p->name] =
                $p->value instanceof PropertyBag
                    ? $p->value->toArray()
                    : $p->value
            ;
        }

        return $array;
    }
}
