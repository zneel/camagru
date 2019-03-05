<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-03-05
 * Time: 15:31
 */

class ImageService
{
    private $image;
    private $stamp;
    private $right_margin = 10;
    private $bottom_margin = 10;
    private $stamp_size_x;
    private $stamp_size_y;
    private $image_size_x;
    private $image_size_y;


    /**
     * ImageService constructor.
     * @param string $image path to the image
     * @param string $stamp path to the stamp image
     */
    public function __construct(string $image, string $stamp)
    {
        $this->setStamp(imagecreatefrompng($stamp));
        $this->setImage(imagecreatefromjpeg($image));
        $this->stamp_size_x = imagesx($this->getStamp());
        $this->stamp_size_y = imagesy($this->getStamp());
        $this->image_size_x = imagesx($this->getImage());
        $this->image_size_y = imagesy($this->getImage());
    }

    public function merge()
    {
        imagecopy($this->getImage(),
            $this->getStamp(),
            $this->image_size_x - $this->stamp_size_x - $this->right_margin,
            $this->image_size_y - $this->stamp_size_y - $this->bottom_margin,
            0, 0,
            $this->stamp_size_x,
            $this->stamp_size_y);
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
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getStamp()
    {
        return $this->stamp;
    }

    /**
     * @param mixed $stamp
     */
    public function setStamp($stamp): void
    {
        $this->stamp = $stamp;
    }
}