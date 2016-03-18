<?php

namespace AppBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Activity
{
    /**
     * @var string The Mongo ID
     *
     * @MongoDB\Id(strategy="auto")
     */
    private $id;

    /**
     * @var Application The application
     *
     * @MongoDB\ReferenceOne(targetDocument="Application")
     */
    private $application;

    /**
     * @var int Duration of the activity
     *
     * @MongoDB\Int
     */
    private $duration;

    /**
     * @var float The distance.
     *
     * @MongoDB\Float
     */
    private $distance;

    /**
     * @var float The calories
     *
     * @MongoDB\Float
     */
    private $kcal;

    /**
     * @var \DateTime The Date.
     *
     * @MongoDB\Date
     */
    private $date;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Application
     */
    public function getApplication()
    {
        return $this->application;
    }

    /**
     * @param Application $application
     */
    public function setApplication($application)
    {
        $this->application = $application;
    }

    /**
     * @return int
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param int $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    /**
     * @return float
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * @param float $distance
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;
    }

    /**
     * @return float
     */
    public function getKcal()
    {
        return $this->kcal;
    }

    /**
     * @param float $kcal
     */
    public function setKcal($kcal)
    {
        $this->kcal = $kcal;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }
}
