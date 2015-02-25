<?php

namespace Vivo\Entity;

use Zend\Stdlib\Hydrator;

abstract class AbstractEntity {

    public function toArray() {
        return (new Hydrator\ClassMethods())->extract($this);
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }
}
