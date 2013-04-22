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
     * @ORM\Column(type="string", nullable=true)
     * @var string $avatar
     * @Annotation\Expose
     */

    protected $avatar;



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
     * Set avatar
     *
     * @param string $avatar
     * @return User
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    
        return $this;
    }

    /**
     * Get avatar
     *
     * @return string 
     */
    public function getAvatar()
    {
        return $this->avatar;
    }
}