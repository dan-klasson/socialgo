<?php

namespace SocialGo\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="member")
 */
class User extends BaseUser
{

    /**
    * @ORM\Id
    * @ORM\Column(type="integer")
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    protected $id;

    /**
    * @var string
    * @ORM\Column(type="string", nullable=true)
    */
    protected $firstname;

    /**
    * @var string
    * @ORM\Column(type="string", nullable=true)
    */
    protected $lastname;

    /**
    * @var string
    * @ORM\Column(type="string", nullable=true)
    */
    protected $bio;

    /**
    * @var string
    * @ORM\Column(type="string", nullable=true)
    */
    protected $avatar;

    /**
    * @var string
    * @ORM\Column(type="string", nullable=true)
    */
    protected $facebookID;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    public function serialize()
    {
        return serialize(array($this->facebookID, parent::serialize()));
    }

    public function unserialize($data)
    {
        list($this->facebookID, $parentData) = unserialize($data);
        parent::unserialize($parentData);
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
    * @return string
    */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
    * @param string $firstname
    */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
    * @return string
    */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
    * @param string $lastname
    */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
    * Get the full name of the user (first + last name)
    * @return string
    */
    public function getFullName()
    {
        return $this->getFirstName() . ' ' . $this->getLastname();
    }

    /**
     * Set bio
     *
     * @param string $bio
     */
    public function setBio($bio)
    {
        $this->bio = $bio;
    }

    /**
     * Get bio
     *
     * @return string 
     */
    public function getBio()
    {
        return $this->bio;
    }


    /**
    * @param string $facebookID
    * @return void
    */
    public function setFacebookID($facebookID)
    {
        $this->facebookID = $facebookID;
        $this->salt = '';
    }

    /**
    * @return string
    */
    public function getFacebookID()
    {
        return $this->facebookID;
    }

    /**
    * @param Array
    */
    public function setFBData($fbdata)
    {
        if (isset($fbdata['id'])) {
            $this->setFacebookID($fbdata['id']);
            $this->addRole('ROLE_FACEBOOK');
        }
        if (isset($fbdata['first_name'])) {
            $this->setFirstname($fbdata['first_name']);
        }
        if (isset($fbdata['last_name'])) {
            $this->setLastname($fbdata['last_name']);
        }
        if (isset($fbdata['email'])) {
            $this->setEmail($fbdata['email']);
        }
        if (isset($fbdata['bio'])) {
            $this->setBio($fbdata['bio']);
        }
        if (isset($fbdata['picture']['data']['url'])) {
            $this->setAvatar($fbdata['picture']['data']['url']);
        }
    }


    /**
     * Set avatar
     *
     * @param string $avatar
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
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
