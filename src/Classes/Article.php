<?php

namespace Democvidev\ChessTeam\Classes;

use Democvidev\ChessTeam\Classes\Generique;

class Article extends Generique
{
    private $id;
    private $art_title;
    private $art_description;
    private $art_content;
    private $art_image;
    private $date_creation;
    private $art_author;
    private $category_id;

    public function __construct(array $data)
    {
        if ($data) {
            parent::__construct($data);
        }
    }


    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Get the value of art_title
     */
    public function getArt_title()
    {
        return $this->art_title;
    }

    /**
     * Set the value of art_title
     *
     * @return  self
     */
    public function setArt_title($art_title)
    {
        $this->art_title = $art_title;

        return $this;
    }

    /**
     * Get the value of art_description
     */
    public function getArt_description()
    {
        return $this->art_description;
    }

    /**
     * Set the value of art_description
     *
     * @return  self
     */
    public function setArt_description($art_description)
    {
        $this->art_description = $art_description;

        return $this;
    }

    /**
     * Get the value of art_content
     */
    public function getArt_content()
    {
        return $this->art_content;
    }

    /**
     * Set the value of art_content
     *
     * @return  self
     */
    public function setArt_content($art_content)
    {
        $this->art_content = $art_content;

        return $this;
    }

    /**
     * Get the value of art_image
     */
    public function getArt_image()
    {
        return $this->art_image;
    }

    /**
     * Set the value of art_image
     *
     * @return  self
     */
    public function setArt_image($art_image)
    {
        $this->art_image = $art_image;

        return $this;
    }

    /**
     * Get the value of art_date_creation
     */
    public function getDate_creation()
    {
        return $this->date_creation;
    }

    /**
     * Set the value of art_date_creation
     *
     * @return  self
     */
    public function setDate_creation($date_creation)
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    /**
     * Get the value of art_author
     */
    public function getArt_author()
    {
        return $this->art_author;
    }

    /**
     * Set the value of art_author
     *
     * @return  self
     */
    public function setArt_author($art_author)
    {
        $this->art_author = $art_author;

        return $this;
    }

    /**
     * Get the value of category_id
     */
    public function getCategory_id()
    {
        return $this->category_id;
    }

    /**
     * Set the value of category_id
     *
     * @return  self
     */
    public function setCategory_id($category_id)
    {
        $this->category_id = $category_id;

        return $this;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}