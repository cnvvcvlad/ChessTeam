<?php

namespace Democvidev\ChessTeam\Classes;

use Democvidev\ChessTeam\Classes\Generique;


class Coach extends Generique
{
    private $id;
    private $last_name;
    private $first_name;
    private $email;
    private $password;
    private $city;
    private $lat;
    private $lon;
    private $coach_image;
    private $price;
    private $description;
    private $nb_stars;
    private $nb_coachings;

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

    /**
     * Get the value of coach_image
     */ 
    public function getCoach_image()
    {
        return $this->coach_image;
    }

    /**
     * Set the value of coach_image
     *
     * @return  self
     */ 
    public function setCoach_image($coach_image)
    {
        $this->coach_image = $coach_image;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of nb_stars
     */ 
    public function getNb_stars()
    {
        return $this->nb_stars;
    }

    /**
     * Set the value of nb_stars
     *
     * @return  self
     */ 
    public function setNb_stars($nb_stars)
    {
        $this->nb_stars = $nb_stars;

        return $this;
    }

    /**
     * Get the value of nb_coachings
     */ 
    public function getNb_coachings()
    {
        return $this->nb_coachings;
    }

    /**
     * Set the value of nb_coachings
     *
     * @return  self
     */ 
    public function setNb_coachings($nb_coachings)
    {
        $this->nb_coachings = $nb_coachings;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
}
