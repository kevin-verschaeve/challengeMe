<?php

namespace AppBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 * @MongoDB\ChangeTrackingPolicy("DEFERRED_IMPLICIT")
 */
class FriendRequest
{
    /**
     * @var string The Mongo ID
     *
     * @MongoDB\Id(strategy="auto")
     */
    private $id;

    /**
     * @var User The user making the friend request
     *
     * @MongoDB\ReferenceOne(targetDocument="User")
     */
    private $requester;

    /**
     * @var User The user requested by the friend request
     *
     * @MongoDB\ReferenceOne(targetDocument="User")
     */
    private $requested;

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
    public function getRequester()
    {
        return $this->requester;
    }

    /**
     * @param User $requester
     */
    public function setRequester($requester)
    {
        $this->requester = $requester;
    }

    /**
     * @return User
     */
    public function getRequested()
    {
        return $this->requested;
    }

    /**
     * @param User $requested
     */
    public function setRequested($requested)
    {
        $this->requested = $requested;
    }
}
