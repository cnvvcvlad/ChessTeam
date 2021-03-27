<?php

namespace App;

class Category extends Generique
{
    private $id;
    private $title;
    private $description;
    private $category_image;
    private $cat_date_creation;
    private $cat_author;

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
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setTitle($title)
    {
        $this->title = $title;

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
     * Get the value of category_image
     */
    public function getCategory_image()
    {
        return $this->category_image;
    }

    /**
     * Set the value of category_image
     *
     * @return  self
     */
    public function setCategory_image($category_image)
    {
        $this->category_image = $category_image;

        return $this;
    }

    /**
     * Get the value of cat_date_creation
     */
    public function getCat_date_creation()
    {
        return $this->cat_date_creation;
    }

    /**
     * Set the value of cat_date_creation
     *
     * @return  self
     */
    public function setCat_date_creation($cat_date_creation)
    {
        $this->cat_date_creation = $cat_date_creation;

        return $this;
    }

    /**
     * Get the value of cat_author
     */
    public function getCat_author()
    {
        return $this->cat_author;
    }

    /**
     * Set the value of cat_author
     *
     * @return  self
     */
    public function setCat_author($cat_author)
    {
        $this->cat_author = $cat_author;

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