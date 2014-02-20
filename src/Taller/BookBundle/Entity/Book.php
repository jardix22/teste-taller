<?php

namespace Taller\BookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Book
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Book
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=200)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=200)
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="summary", type="text")
     */
    private $summary;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="edition_date", type="date")
     */
    private $editionDate;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     * @Assert\Image(maxSize = "500k")
     */
    private $image;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Book
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set author
     *
     * @param string $author
     * @return Book
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set summary
     *
     * @param string $summary
     * @return Book
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * Get summary
     *
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Set editionDate
     *
     * @param \DateTime $editionDate
     * @return Book
     */
    public function setEditionDate($editionDate)
    {
        $this->editionDate = $editionDate;

        return $this;
    }

    /**
     * Get editionDate
     *
     * @return \DateTime
     */
    public function getEditionDate()
    {
        return $this->editionDate;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Book
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Load Image
     * @param string $directory
     *   Is the absolute directory path where uploaded images should be saved
     *
     */
    public function loadImage($directory)
    {
        if (null === $this->image) {
            return;
        }

        $nameImageFile = uniqid('taller-').'-foto1.jpg';
        $this->image->move($directory, $nameImageFile);
        $this->setImage($nameImageFile);
    }
}
