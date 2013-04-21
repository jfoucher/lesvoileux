<?php

namespace Voileux\CoreBundle\Entity;

use JMS\Serializer\Annotation;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation\Timestampable;

/**
 * Boat
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Voileux\CoreBundle\Entity\BoatRepository")
 */
class Boat
{

    const RENT_TYPE_WITH_SKIPPER = 1;
    const RENT_TYPE_WITHOUT_SKIPPER = 2;

    const BOAT_POSITION_HOME = 1;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Annotation\Expose
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Annotation\Expose
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     * @Annotation\Expose
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     * @Annotation\Expose
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="rentType", type="integer")
     * @Annotation\Expose
     */
    private $rentType;


    /**
     * @var array
     *
     * @ORM\Column(name="photos", type="array")
     * @Annotation\Expose
     */
    private $photos;

    /**
     * @var integer
     *
     * @ORM\Column(name="minRentDuration", type="integer")
     * @Annotation\Expose
     */
    private $minRentDuration;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer")
     * @Annotation\Expose
     */
    private $position;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     * @Annotation\Expose
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255)
     * @Annotation\Expose
     */
    private $country;

    /**
     * @var float
     *
     * @ORM\Column(name="length", type="float")
     * @Annotation\Expose
     */
    private $length;

    /**
     * @var float
     *
     * @ORM\Column(name="pricePerDay", type="float")
     * @Annotation\Expose
     */
    private $pricePerDay;

    /**
     * @var string
     *
     * @ORM\Column(name="currency", type="string", length=8)
     * @Annotation\Expose
     */
    private $currency;

    /**
     * @var integer
     *
     * @ORM\Column(name="cabins", type="integer")
     * @Annotation\Expose
     */
    private $cabins;

    /**
     * @var integer
     *
     * @ORM\Column(name="accomodation", type="integer")
     * @Annotation\Expose
     */
    private $accomodation;

    /**
     * This boat belongs to this user
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="boats")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * @Annotation\Expose
     */
    private $owner;


    /**
     * @var datetime $createdAt
     *
     * @ORM\Column(name="createdAt", type="datetime")
     * @Timestampable(on="create")
     * @Annotation\Expose
     * @Annotation\SerializedName("created_at")
     */
    private $createdAt;

    /**
     * @var datetime $updatedAt
     * @Annotation\Expose
     * @Annotation\SerializedName("updated_at")
     * @ORM\Column(name="updatedAt", type="datetime")
     * @Timestampable(on="update")
     */
    private $updatedAt;

    public function __construct()
    {
        $this->currency = 'EUR';
        $this->photos = array();
    }


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
     * @return Boat
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
     * Set description
     *
     * @param string $description
     * @return Boat
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set rentType
     *
     * @param integer $rentType
     * @return Boat
     */
    public function setRentType($rentType)
    {
        $this->rentType = $rentType;
    
        return $this;
    }

    /**
     * Get rentType
     *
     * @return integer 
     */
    public function getRentType()
    {
        return $this->rentType;
    }

    /**
     * Set minRentDuration
     *
     * @param integer $minRentDuration
     * @return Boat
     */
    public function setMinRentDuration($minRentDuration)
    {
        $this->minRentDuration = $minRentDuration;
    
        return $this;
    }

    /**
     * Get minRentDuration
     *
     * @return integer 
     */
    public function getMinRentDuration()
    {
        return $this->minRentDuration;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Boat
     */
    public function setCity($city)
    {
        $this->city = $city;
    
        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Boat
     */
    public function setCountry($country)
    {
        $this->country = $country;
    
        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set length
     *
     * @param string $length
     * @return Boat
     */
    public function setLength($length)
    {
        $this->length = $length;
    
        return $this;
    }

    /**
     * Get length
     *
     * @return string 
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set cabins
     *
     * @param string $cabins
     * @return Boat
     */
    public function setCabins($cabins)
    {
        $this->cabins = $cabins;
    
        return $this;
    }

    /**
     * Get cabins
     *
     * @return string 
     */
    public function getCabins()
    {
        return $this->cabins;
    }

    /**
     * Set accomodation
     *
     * @param string $accomodation
     * @return Boat
     */
    public function setAccomodation($accomodation)
    {
        $this->accomodation = $accomodation;
    
        return $this;
    }

    /**
     * Get accomodation
     *
     * @return string 
     */
    public function getAccomodation()
    {
        return $this->accomodation;
    }

    /**
     * Set owner
     *
     * @param \Voileux\CoreBundle\Entity\User $owner
     * @return Boat
     */
    public function setOwner(\Voileux\CoreBundle\Entity\User $owner)
    {
        $this->owner = $owner;
    
        return $this;
    }

    /**
     * Get owner
     *
     * @return \Voileux\CoreBundle\Entity\User 
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set pricePerDay
     *
     * @param float $pricePerDay
     * @return Boat
     */
    public function setPricePerDay($pricePerDay)
    {
        $this->pricePerDay = $pricePerDay;
    
        return $this;
    }

    /**
     * Get pricePerDay
     *
     * @return float 
     */
    public function getPricePerDay()
    {
        return $this->pricePerDay;
    }

    /**
     * Set currency
     *
     * @param string $currency
     * @return Boat
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    
        return $this;
    }

    /**
     * Get currency
     *
     * @return string 
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set photos
     *
     * @param array $photos
     * @return Boat
     */
    public function setPhotos($photos)
    {
        $this->photos = $photos;
    
        return $this;
    }

    /**
     * Get photos
     *
     * @return array 
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Boat
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return Boat
     */
    public function setPosition($position)
    {
        $this->position = $position;
    
        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Boat
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Boat
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    
        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}