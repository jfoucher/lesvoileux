<?php
/**
 * BoatManager.php
 *
 * Created By: jonathan
 * Date: 4/19/13
 * Time: 1:29 PM
 */

namespace Voileux\CoreBundle\Entity;
use Voileux\CoreBundle\Entity\Boat;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityRepository;


class BoatManager
{
    protected $em;
    protected $container;
    protected $repository;

    public function __construct(EntityManager $em, ContainerInterface $container, EntityRepository $repository)
    {
        $this->em = $em;
        $this->container = $container;
        $this->repository = $repository;
    }


    public function findAll()
    {
        return $this->repository->findAll();
    }

    public function findByPosition($position)
    {
        return $this->repository->findBy(array('position' => $position));
    }

    public function findOneBy($params)
    {
        return $this->repository->findOneBy($params);
    }

    public function getLatest($count)
    {
        return $this->repository->findBy(array(), array('updatedAt' => 'desc'), $count);
    }
}
