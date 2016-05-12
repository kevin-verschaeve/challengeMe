<?php

namespace AppBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class UserApplication
{
    /**
     * @var string The Mongo ID
     *
     * @MongoDB\Id(strategy="auto")
     */
    private $id;

    /**
     * @var User
     *
     * @MongoDB\ReferenceOne(targetDocument="User")
     */
    private $user;

    /**
     * @var Application
     *
     * @MongoDB\ReferenceOne(targetDocument="Application")
     */
    private $application;

    /**
     * @var string The username of the user in the application (can be different in function of the application)
     *
     * @MongoDB\String
     */
    private $applicationUsername;

    /**
     * @var string
     *
     * @MongoDB\String
     */
    private $password;

    /**
     * @var bool
     *
     * @MongoDB\Boolean
     */
    private $enabled;

    /**
     * @var string
     *
     * @MongoDB\String
     */
    private $accessToken;

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
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
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
     * @return string
     */
    public function getApplicationUsername()
    {
        return $this->applicationUsername;
    }

    /**
     * @param string $applicationUsername
     */
    public function setApplicationUsername($applicationUsername)
    {
        $this->applicationUsername = $applicationUsername;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return boolean
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param boolean $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param string $accessToken
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }
}
