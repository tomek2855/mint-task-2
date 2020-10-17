<?php


namespace App\Security;

use App\Entity\User;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface
{

    public function checkPreAuth(UserInterface $user)
    {
    }

    public function checkPostAuth(UserInterface $user)
    {
        if (!$user instanceof User)
        {
            return;
        }

        if ($user->getDisabled())
        {
            throw new CustomUserMessageAccountStatusException("User is disabled");
        }
    }
}