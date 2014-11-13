<?php

/**
 * Author: Podluzhnyy Vladimir aka Quber
 * Contact: quber.one@gmail.com
 * Date & Time: 12.11.2014 / 15:00
 * Filename: User.php
 * Notes: Special for Domotehnika
 */

namespace Test\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * The User's entity class.
 * Cannot use name "User" for table name, because it is reserved word by SQL
 * @ORM\Entity(repositoryClass="Test\UserBundle\Entity\UserRepository")
 * @ORM\Table(name="test_user")
 * @package Test\UserBundle\Entity
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
     * User's nickname
     *
     * @ORM\Column(length=30, nullable=true)
     */
    protected $nick;

    public function __construct()
    {
        parent::__construct();
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
     * Set nick
     *
     * @param string $nick
     * @return User
     */
    public function setNick($nick)
    {
        $this->nick = $nick;

        return $this;
    }

    /**
     * Get nick
     *
     * @return string 
     */
    public function getNick()
    {
        return $this->nick;
    }
}
