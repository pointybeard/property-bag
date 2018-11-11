<?php

namespace pointybeard\PropertyBag\Lib;

class PropertyBag implements \Iterator{

    protected $properties = [];
    protected $position = 0;

    protected function keyFromPosition($position) {
        $index = array_keys($this->properties);
        return isset($index[$position]) ? $index[$position] : -1;
    }

    public function rewind() {
        $this->position = 0;
    }

    public function current() {
        return $this->properties[$this->keyFromPosition($this->position)];
    }

    public function key() {
        return $this->keyFromPosition($this->position);
    }

    public function next() {
        ++$this->position;
    }

    public function valid() {
        return isset($this->properties[$this->keyFromPosition($this->position)]);
    }

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
