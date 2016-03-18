<?php

namespace AppBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Challenge
{
    /**
     * @var string The Mongo ID
     *
     * @MongoDB\Id(strategy="auto")
     */
    private $id;

    /**
     * @var User The challenger
     *
     * @MongoDB\ReferenceOne(targetDocument="User", simple=true)
     */
    private $challenger;

    /**
     * @var User The challenged
     *
     * @MongoDB\ReferenceOne(targetDocument="User", simple=true)
     */
    private $challenged;

    /**
     * @var Status The status of the challenge
     *
     * @MongoDB\ReferenceOne(targetDocument="Status")
     */
    private $status;

    /**
     * @var string
     * @MongoDB\String
     */
    private $comment;

    /**
     * @var \DateTime
     *
     * @MongoDB\Date
     */
    private $realizedAt;

    /**
     * @var \DateTime
     *
     * @MongoDB\Date
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @MongoDB\Date
     */
    private $endDate;

    /**
     * @var int The challenge number in the iteration
     *
     * @MongoDB\Int
     */
    private $challengeNumber = 1;

    /**
     * @var float The required distance to win the challenge
     *
     * @MongoDB\Float
     */
    private $requiredDistance;

    /**
     * @var float The realized distance
     *
     * @MongoDB\Float
     */
    private $realizedDistance;

    /**
     * @var float The required duration to win the challenge
     *
     * @MongoDB\Float
     */
    private $requiredDuration;

    /**
     * @var float The realized duration
     *
     * @MongoDB\Float
     */
    private $realizedDuration;

    /**
     * @var int The quantity of points to get when the challenge is won
     *
     * @MongoDB\Int
     */
    private $points;

    /**
     * @var Activity The activity related to the challenge
     *
     * @MongoDB\ReferenceOne(targetDocument="Activity")
     */
    private $activity;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getChallenger()
    {
        return $this->challenger;
    }

    /**
     * @param User $challenger
     */
    public function setChallenger($challenger)
    {
        $this->challenger = $challenger;
    }

    /**
     * @return User
     */
    public function getChallenged()
    {
        return $this->challenged;
    }

    /**
     * @param User $challenged
     */
    public function setChallenged($challenged)
    {
        $this->challenged = $challenged;
    }

    /**
     * @return Status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param Status $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return \DateTime
     */
    public function getRealizedAt()
    {
        return $this->realizedAt;
    }

    /**
     * @param \DateTime $realizedAt
     */
    public function setRealizedAt($realizedAt)
    {
        $this->realizedAt = $realizedAt;
    }

    /**
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param \DateTime $startDate
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param \DateTime $endDate
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }

    /**
     * @return int
     */
    public function getChallengeNumber()
    {
        return $this->challengeNumber;
    }

    /**
     * @param int $challengeNumber
     */
    public function setChallengeNumber($challengeNumber)
    {
        $this->challengeNumber = $challengeNumber;
    }

    /**
     * @return float
     */
    public function getRequiredDistance()
    {
        return $this->requiredDistance;
    }

    /**
     * @param float $requiredDistance
     */
    public function setRequiredDistance($requiredDistance)
    {
        $this->requiredDistance = $requiredDistance;
    }

    /**
     * @return float
     */
    public function getRealizedDistance()
    {
        return $this->realizedDistance;
    }

    /**
     * @param float $realizedDistance
     */
    public function setRealizedDistance($realizedDistance)
    {
        $this->realizedDistance = $realizedDistance;
    }

    /**
     * @return float
     */
    public function getRequiredDuration()
    {
        return $this->requiredDuration;
    }

    /**
     * @param float $requiredDuration
     */
    public function setRequiredDuration($requiredDuration)
    {
        $this->requiredDuration = $requiredDuration;
    }

    /**
     * @return float
     */
    public function getRealizedDuration()
    {
        return $this->realizedDuration;
    }

    /**
     * @param float $realizedDuration
     */
    public function setRealizedDuration($realizedDuration)
    {
        $this->realizedDuration = $realizedDuration;
    }

    /**
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @param int $points
     */
    public function setPoints($points)
    {
        $this->points = $points;
    }

    /**
     * @return Activity
     */
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * @param Activity $activity
     */
    public function setActivity($activity)
    {
        $this->activity = $activity;
    }

    /**
     * @return \DateInterval
     */
    public function getTimeRemaining()
    {
        return $this->getEndDate()->diff(new \DateTime());
    }

    /**
     * TODO export this logic code
     * @return string
     */
    public function getTimeRemainingFormated()
    {
        $diff = $this->getTimeRemaining();

        $format = '';

        if ($diff->i > 0) {
            $format = '%Imin ' . $format;
        }

        if ($diff->h > 0) {
            $format = '%Hh ' . $format;
        }

        if ($diff->d > 0) {
            $format = '%dj ' . $format;
        }

        return $diff->format(trim($format));
    }
}
