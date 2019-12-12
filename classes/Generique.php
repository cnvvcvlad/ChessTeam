<?php

abstract class Generique
{

    public function __construct(array $data = null)
    {
        if ($data) {
            $this->init($data);
        }
    }

    public function init(array $data)
    {
        foreach ($data as $property => $value) {

            $methods = 'set' . ucfirst($property);

            if (method_exists($this, $methods)) {
                $this->$methods($value);
            }
        }
    }

}