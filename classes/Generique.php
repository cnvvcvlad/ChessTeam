<?php

abstract class Generique
{

    const MAX_LENGTH_TITLE = 100;

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

//    public function validateTitle($title)
//    {
//        if (strlen($title) > self::MAX_LENGTH_TITLE) {
//            throw new \Exception("Le titre est trop long");
//        }
//        return true;
//    }
}