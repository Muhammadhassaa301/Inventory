<?php

namespace App\Traits;

trait hasMeta
{
    /**
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
        // First we will check if $name is a reserverdKey
        // if it is a reservedKey we will call setAttribute method of Model Class
        // Otherwise we will add/update Meta of given entity

        if (in_array($name, $this->reservedKeys)) {
            $this->setAttribute($name, $value);
        } else {
            $meta = $this->getAttribute('meta');
            $meta[$name] = $value;
            $this->setAttribute('meta', $meta);
        }

    }


    public function __get($key)
    {


        // First we will check if key is not a reserverdKey
        // if it is not then we will search key in meta
        // Otherwise we will call the parent getter

        if (!in_array($key, $this->reservedKeys)) {
            $meta = $this->getAttribute('meta');
            if (isset($meta[$key]))
                return $meta[$key];

        }
        return parent::__get($key);


    }
}
