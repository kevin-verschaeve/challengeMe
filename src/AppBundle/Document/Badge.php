<?php

namespace AppBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Badge
{
    /**
     * @var string The Mongo ID
     *
     * @MongoDB\Id(strategy="auto")
     */
    private $id;

    /**
     * @var string The badge name
     *
     * @MongoDB\String
     */
    private $name;

    /**
     * @var string The badge description
     *
     * @MongoDB\String
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @MongoDB\Date
     */
    private $updatedAt;

    /**
     * @var int Bonus points offered by the badge
     *
     * @MongoDB\Int
     */
    private $bonusPoints;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return int
     */
    public function getBonusPoints()
    {
        return $this->bonusPoints;
    }

    /**
     * @param int $bonusPoints
     */
    public function setBonusPoints($bonusPoints)
    {
        $this->bonusPoints = $bonusPoints;
    }
}
