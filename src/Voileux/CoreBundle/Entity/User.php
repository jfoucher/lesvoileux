<?php

namespace Voileux\CoreBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation;



/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @Annotation\ExclusionPolicy("all")
 *
 */
class User extends BaseUser
{


    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Annotation\Exclude
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string $name
     * @Annotation\Expose
     */

    protected $name;


    /**
     * @var int $level
     * @Annotation\Expose
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $level;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set level
     *
     * @param integer $level
     * @return User
     */
    public function setLevel($level)
    {
        $this->level = $level;
    
        return $this;
    }

    /**
     * Get level
     *
     * @return integer 
     */
    public function getLevel()
    {
        return $this->level;
    }
}