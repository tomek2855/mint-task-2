<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    const TEST_USERS_PASS = 'qwerty';

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->passwordEncoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 33; $i++)
        {
            $user = new User();
            $user->setUsername('test' . $i);
            $user->setPassword(
                $this->passwordEncoder->encodePassword($user, self::TEST_USERS_PASS)
            );

            $manager->persist($user);
        }

        $manager->flush();
    }
}
