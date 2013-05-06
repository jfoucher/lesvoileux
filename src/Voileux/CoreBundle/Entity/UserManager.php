<?php

namespace Voileux\CoreBundle\Entity;

use Voileux\CoreBundle\Entity\User;
use FOS\UserBundle\Entity\UserManager as BaseUserManager;
use FOS\UserBundle\Model\UserInterface;
use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Model\UserManagerInterface;

class UserManager extends BaseUserManager implements UserManagerInterface
{

    public function findBy($params, $order, $limit)
    {
        return $this->repository->findBy($params, $order, $limit);
    }

    public function findByEmail($email)
    {
        return $this->repository->findOneByEmail($email);
    }

    public function findUserByPublicId($publicId)
    {
        if (false === $pos = strpos($publicId, '_')) {
            return;
        }

        $id = substr($publicId, 0, $pos);
        $random = substr($publicId, $pos+1);

        $user = $this->em->find($this->class, $id);


        if (!$user) {
            return;
        }

        if (!String::constantTimeCompare($random, $user->getRandomId())) {
            return;
        }

        return $user;
    }

    /**
     * Updates a user.
     *
     * @param UserInterface $user
     * @param Boolean       $andFlush Whether to flush the changes (default true)
     */
    public function updateUser(UserInterface $user, $andFlush = true)
    {
        parent::updateUser($user, $andFlush);

    }


    public function mergeUser(User $user, $andReload = false)
    {
        $account = $this->em->merge($user);

        if ($andReload) {
            $this->reloadUser($user);
        }

        return $account;
    }

    public function supportsClass($class)
    {
        
        return $class == 'Voileux\CoreBundle\Entity\User';
    }

}
