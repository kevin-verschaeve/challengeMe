<?php

namespace AppBundle\Document;

use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Application
{
    /**
     * @var string The Mongo ID
     *
     * @MongoDB\Id(strategy="auto")
     */
    private $id;

    /**
     * @var string The application name
     *
     * @MongoDB\String
     */
    private $name;

    /**
     * @var Collection|User[]
     *
     * @MongoDB\ReferenceMany(targetDocument="UserApplication", mappedBy="user")
     */
    private $users;

    /**
     * @var string The description
     *
     * @MongoDB\String
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @MongoDB\Date
     */
    private $updated_at;

    public function __construct()
    {
        $this->setUpdatedAt(new \DateTime());
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
        return $this->updated_at;
    }

    /**
     * @param \DateTime $updated_at
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @return User[]|Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    public function addUser(User $user)
    {
        if ($this->users->contains($user)) {
            return;
        }

        $this->users->add($user);
    }

    /**
     * @param User[]|Collection $users
     */
    public function setUsers($users)
    {
        $this->users->clear();
        $this->users = $users;
    }
}
