<?php
/**
 * User: jonathan
 * Date: 11/14/12
 * Time: 10:41 PM
 */

namespace Voileux\CoreBundle\DataFixtures\ORM;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Voileux\CoreBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;

class LoadUserData extends AbstractFixture
{

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        $users = array(
            array(
                'name' => 'Marc Audonnet',
                'username' => 'marcaudonnet',
                'email' => 'felucalias@gmail.com',
                'password' => 'qwerty',
            ),
            array(
                'name' => 'Jean-Marc Yebra',
                'username' => 'jmyebra',
                'email' => 'ycandy2@free.fr',
                'password' => 'qwerty',
            ),
            array(
                'name' => 'Thierry Fabre',
                'avatar' => 'thierry-skipper-ondine-charter.jpg',
                'username' => 'tfabre',
                'email' => 'info@croisiere-chasse-nosybe.com',
                'password' => 'qwerty',
            ),
            array(
                'name' => 'admin',
                'username' => 'admin',
                'email' => 'admin@admin.com',
                'password' => 'azerty',
                'role' => 'ROLE_SUPER_ADMIN',
            ),
        );



        foreach($users as $user) {
            $this->loadUser($user, $manager);
        }
        $manager->flush();
    }

    private function loadUser($user, ObjectManager $manager)
    {
        $userAdmin = new User();
        $userAdmin->setName($user['name']);
        $userAdmin->setUsername($user['username']);
        if(isset($user['avatar'])) {
            $userAdmin->setAvatar($user['avatar']);
        }

        $userAdmin->setEmail($user['email']);
        $userAdmin->setPlainPassword($user['password']);
        $userAdmin->setEnabled(true);

        if(isset($user['role'])) {
            $userAdmin->addRole($user['role']);
        }

        $this->setReference('user-'.$user['username'], $userAdmin);

        $manager->persist($userAdmin);

    }

}