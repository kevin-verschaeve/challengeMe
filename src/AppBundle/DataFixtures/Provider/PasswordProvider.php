<?php

namespace AppBundle\DataFixtures\Provider;

use AppBundle\Document\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;

class PasswordProvider
{
    private $encoder;

    public function __construct(UserPasswordEncoder $encoder)
    {
        $this->encoder = $encoder;
    }

    public function password($password = 'pass')
    {
        $user = new User();
        return $this->encoder->encodePassword($user, $password);
    }
}
