<?php

/**
 * Created by PhpStorm.
 * User: Pushpe
 * Date: 3/24/2018
 * Time: 4:35 PM
 */
namespace AppBundle\Structs;
class Product
{
    private $name;
    private $aliexpressId;
    private $image;
    private $price;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getAliexpressId()
    {
        return $this->aliexpressId;
    }

    /**
     * @param mixed $aliexpressId
     */
    public function setAliexpressId($aliexpressId)
    {
        $this->aliexpressId = $aliexpressId;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }


}