<?php

namespace AppBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Most of the fields comes from "BaseUser", we override them to map them to mongoDB
 *
 * @MongoDB\Document
 */
class User extends BaseUser
{
    /**
     * @var string The Mongo ID
     *
     * @MongoDB\Id(strategy="auto")
     */
    protected $id;

    /**
     * @MongoDB\String
     */
    protected $username;

    /**
     * @MongoDB\String
     */
    protected $usernameCanonical;

    /**
     * @MongoDB\String
     */
    protected $email;

    /**
     * @MongoDB\Bool
     */
    protected $enabled;

    /**
     * @MongoDB\String
     */
    protected $salt;

    /**
     * @MongoDB\String
     */
    protected $password;

    /**
     * @MongoDB\Hash
     */
    protected $roles;

    /**
     * @var Collection|User[]
     *
     * @MongoDB\ReferenceMany(targetDocument="User", mappedBy="friends")
     */
    private $friendsWithMe;

    /**
     * @var Collection|User[]
     *
     * @MongoDB\ReferenceMany(targetDocument="User", inversedBy="friendsWithMe")
     */
    private $friends;

    /**
     * @var string
     *
     * @MongoDB\String
     */
    private $facebookId;

    /**
     * @var int Total of points won by the user
     *
     * @MongoDB\Int
     */
    private $totalPoints;

    /**
     * @var Collection|Application[] The applications the user connected
     *
     * @MongoDB\ReferenceMany(targetDocument="UserApplication", mappedBy="application")
     */
    private $applications;

    /**
     * @var Collection|Challenge[]
     *
     * @MongoDB\ReferenceMany(targetDocument="Challenge", mappedBy="challenger", sort={"date"="DESC"})
     */
    private $challenges;

    /**
     * @var Collection|Badge[]
     *
     * @MongoDB\ReferenceMany(targetDocument="Badge")
     */
    private $badges;

    /**
     * @var Collection|Activity[]
     *
     * @MongoDB\ReferenceMany(targetDocument="Activity")
     */
    private $activities;

    /**
     * @var bool
     *
     * @MongoDB\Boolean
     */
    private $updated;

    public function __construct()
    {
        parent::__construct();

        $this->applications = new ArrayCollection();
        $this->friendsWithMe = new ArrayCollection();
        $this->friends = new ArrayCollection();
        $this->challenges = new ArrayCollection();
        $this->badges = new ArrayCollection();
        $this->activities = new ArrayCollection();
        $this->updated = false;
        $this->enabled = true;
    }

    /**
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string $facebookId
     */
    public function getFacebookId()
    {
        return $this->facebookId;
    }

    /**
     * @param string $facebookId
     * @return self
     */
    public function setFacebookId($facebookId)
    {
        $this->facebookId = $facebookId;

        return $this;
    }

    /**
     * @return int $totalPoints
     */
    public function getTotalPoints()
    {
        return $this->totalPoints;
    }

    /**
     * @param int $totalPoints
     * @return self
     */
    public function setTotalPoints($totalPoints)
    {
        $this->totalPoints = $totalPoints;

        return $this;
    }

    /**
     * @param Application $application
     */
    public function addApplication(Application $application)
    {
        if ($this->applications->contains($application)) {
            return;
        }

        $this->applications->add($application);
    }

    /**
     * @param Application $application
     */
    public function removeApplication(Application $application)
    {
        $this->applications->removeElement($application);
    }

    /**
     * @return Collection $applications
     */
    public function getApplications()
    {
        return $this->applications;
    }

    /**
     * Set applications
     *
     * @param $applications
     * @return $this
     */
    public function setApplications($applications)
    {
        $this->applications = $applications;

        return $this;
    }

    /**
     * @param Challenge $challenge
     */
    public function addChallenge(Challenge $challenge)
    {
        $this->challenges[] = $challenge;
    }

    /**
     * @param Challenge $challenge
     */
    public function removeChallenge(Challenge $challenge)
    {
        $this->challenges->removeElement($challenge);
    }

    /**
     * @return Collection $challenges
     */
    public function getChallenges()
    {
        return $this->challenges;
    }

    /**
     * @param $challenges
     * @return $this
     */
    public function setChallenges($challenges)
    {
        $this->challenges = $challenges;

        return $this;
    }

    /**
     * @return Collection $badges
     */
    public function getBadges()
    {
        return $this->badges;
    }

    /**
     * @param Badge $badge
     */
    public function addBadge(Badge $badge)
    {
        if ($this->badges->contains($badge)) {
            return;
        }

        $this->badges->add($badge);
    }

    /**
     * Remove badge
     *
     * @param \AppBundle\Document\Badge $badge
     */
    public function removeBadge(Badge $badge)
    {
        $this->badges->removeElement($badge);
    }

    /**
     * @return Collection $activities
     */
    public function getActivities()
    {
        return $this->activities;
    }

    /**
     * @param Activity $activity
     */
    public function addActivity(Activity $activity)
    {
        if ($this->activities->contains($activity)) {
            return;
        }

        $this->activities->add($activity);
    }

    /**
     * @param Activity $activity
     */
    public function removeActivities(Activity $activity)
    {
        $this->activities->removeElement($activity);
    }

    /**
     * @return Collection $friendsWithMe
     */
    public function getFriendsWithMe()
    {
        return $this->friendsWithMe;
    }

    /**
     * @param User $friendsWithMe
     */
    public function addFriendsWithMe(User $friendsWithMe)
    {
        $this->friendsWithMe[] = $friendsWithMe;
    }

    /**
     * Remove friendsWithMe
     *
     * @param User $friendsWithMe
     */
    public function removeFriendsWithMe(User $friendsWithMe)
    {
        $this->friendsWithMe->removeElement($friendsWithMe);
    }

    /**
     * retourne les amis de l'utilisateur en cours
     */
    public function getFriends()
    {
        return $this->friends;
    }

    public function addUserFriend(User $friend)
    {
        $this->friends[] = $friend;
    }

    /**
     * Remove userFriend
     *
     * @param User $friend
     */
    public function removeUserFriend(User $friend)
    {
        $this->friends->removeElement($friend);
    }

    public function addFriend(User $user)
    {
        /**
         * TODO A vérifier que ca fonctionne
         */
        $user->friends[$this->getId()] = $this;
        $this->friends[$user->getId()] = $user;
        //$user->friendsWithMe[] = $this;
    }

    /**
     * @return boolean
     */
    public function isUpdated()
    {
        return (bool)$this->updated;
    }

    /**
     * Get updated
     *
     * @return boolean $updated
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param boolean $updated
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }

    /**
     * Remove friend
     *
     * @param \AppBundle\Document\User $friend
     */
    public function removeFriend(User $friend)
    {
        $this->friends->removeElement($friend);
    }

    /**
     * TODO: Check if necessary
     *
     * The serialized data have to contain the fields used by the equals method and the username.
     *
     * @return string
     */
    public function serialize()
    {
        return serialize([
            $this->password,
            $this->salt,
            $this->usernameCanonical,
            $this->username,
            $this->expired,
            $this->locked,
            $this->credentialsExpired,
            $this->enabled,
            $this->id,
            $this->facebookId
        ]);
    }

    /**
     * TODO: Check if necessary
     *
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        $data = unserialize($serialized);
        $data = array_merge($data, array_fill(0, 2, null));

        list(
            $this->password,
            $this->salt,
            $this->usernameCanonical,
            $this->username,
            $this->expired,
            $this->locked,
            $this->credentialsExpired,
            $this->enabled,
            $this->id
            ) = $data;
    }
}
