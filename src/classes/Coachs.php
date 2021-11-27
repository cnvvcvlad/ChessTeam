<?php

namespace Democvidev\ChessTeam\Classes;

use Democvidev\ChessTeam\Classes\Generique;


class Coachs extends Generique
{
    private $id;
    private $last_name;
    private $first_name;
    private $city;
    private $lat;
    private $lon;

    public function __construct(array $data)
    {
        if ($data) {
            parent::__construct($data);
        }
    }

    /**
     * Get the value of id_coach
     */

    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of last_name
     */

    public function getLast_name()
    {
        return $this->last_name;
    }

    /**
     * Set the value of last_name
     *
     * @return  self
     */

    public function setLast_name($last_name)
    {
        $this->last_name = $last_name;

        return $this;
    }

    /**
     * Get the value of first_name
     */

    public function getFirst_name()
    {
        return $this->first_name;
    }

    /**
     * Set the value of first_name
     *
     * @return  self
     */

    public function setFirst_name($first_name)
    {
        $this->first_name = $first_name;

        return $this;
    }

    /**
     * Get the value of city
     */

    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set the value of city
     *
     * @return  self
     */

    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get the value of lat
     */

    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set the value of lat
     *
     * @return  self
     */

    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get the value of lon
     */

    public function getLon()
    {
        return $this->lon;
    }

    /**
     * Set the value of lon
     *
     * @return  self
     */

    public function setLon($lon)
    {
        $this->lon = $lon;

        return $this;
    }
}
