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
     * These boats belong to this user
     *
     * @ORM\OneToMany(targetEntity="Boat", mappedBy="owner")
     * @ORM\JoinColumn(nullable=true)
     * @Annotation\Expose
     */
    private $boats;


    /**
     * @var string $persona_email
     *
     * @ORM\Column(name="persona_email", type="string", length=255, nullable=true)
     */
    protected $persona_email;


    /**
     * @ORM\Column(name="persona_expires", type="string", nullable=true)
     */
    protected $persona_expires;

    /**
     * @var string persona_lastStatus
     * @ORM\Column(name="persona_last_status", type="string", length=8, nullable=true)
     */
    protected $persona_lastStatus;


    /**
     * @var string persona_lastFailReason
     * @ORM\Column(name="persona_last_fail_reason", type="string", nullable=true)
     */
    protected $persona_lastFailReason;

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


    /**
     * @param string $persona_lastStatus
     */
    public function setPersonaLastStatus($persona_lastStatus)
    {
        $this->persona_lastStatus = $persona_lastStatus;
    }

    /**
     * @return string
     */
    public function getPersonaLastStatus()
    {
        return $this->persona_lastStatus;
    }

    /**
     * @param string $persona_lastFailReason
     */
    public function setPersonaLastFailReason($persona_lastFailReason)
    {
        $this->persona_lastFailReason = $persona_lastFailReason;
    }

    /**
     * @return string
     */
    public function getPersonaLastFailReason()
    {
        return $this->persona_lastFailReason;
    }

    public function setPersonaExpires($persona_expires)
    {
        $this->persona_expires = $persona_expires;
    }

    public function getPersonaExpires()
    {
        return $this->persona_expires;
    }

    /**
     * @param string $persona_email
     */
    public function setPersonaEmail($persona_email)
    {
        $this->persona_email = $persona_email;
    }

    /**
     * @return string
     */
    public function getPersonaEmail()
    {
        return $this->persona_email;
    }
    /***
     * Set users personaId
     *
     * @param $persona_email
     */
    public function setPersonaId($persona_email)
    {
        $this->email = $persona_email;
        $this->emailCanonical = $this->email;
        $this->setUsername($this->email);
        $this->setPersonaEmail($this->email);
        $this->salt = '';
    }

    public function setBoats($boats)
    {
        $this->boats = $boats;
        return $this;
    }

    public function getBoats()
    {
        return $this->boats;
    }
}