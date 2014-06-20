<?php
namespace Cuser\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
class User 
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;
    
    /** @ORM\Column(type="string") */
    protected $username;
    
    /** @ORM\Column(type="string") */
    protected $password;
    
    /** @ORM\Column(type="string") */
    protected $fullName;
    
    /** @ORM\Column(type="string") */
    protected $email;
    
    /** @ORM\Column(type="integer") */
    protected $active;
    
    /** @ORM\ManyToOne(targetEntity="Role") */
    protected $role;
    
    /** @ORM\Column(type="datetime") */
    protected $joinDate;
    
    /** @ORM\Column(type="datetime", nullable=true) */
    protected $updateDate;
    
    
    public function exchangeArray($data = array())
    {
    	$this->username 	= (isset($data['username'])) ? $data['username'] : null;
    	$this->password 	= (isset($data['password'])) ? $data['password'] : null;
    	$this->fullName 	= (isset($data['fullName'])) ? $data['fullName'] : null;
    	$this->email	 	= (isset($data['email'])) ? $data['email'] : null;
    	$this->active 		= (isset($data['active'])) ? $data['active'] : 1;
    	$this->role 		= (isset($data['role'])) ? $data['role'] : null;
    	$this->joinDate 	= (isset($data['joinDate'])) ? $data['joinDate'] : new DateTime();
    	$this->updateDate 	= (isset($data['updateDate'])) ? $data['updateDate'] : null;
    	
    }
    
    public function setUsername($val)
    {
        $this->username = $val;
    }
    
    public function getUsername()
    {
        return $this->username;
    }
    
    public function setEmail($val)
    {
        $this->email = $val;
    }
    
    public function getEmail()
    {
    	return $this->email;
    }
    
    public function setPassword($val)
    {
        $this->password = $val;
    }
    
    public function getPassword()
    {
        return $this->password;
    }

    public function setActive($val)
    {
         $this->active = $val;
    }

    public function getActive()
    {
        return $this->active;
    }
    
    public function setFullName($val)
    {
        $this->fullName = $val;
    }

    public function getFullName()
    {
        return $this->fullName;
    }
    public function setRole($val)
    {
        $this->role = $val;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setJoinDate($val)
    {
    	$this->joinDate = $val;
    }
    
    public function getJoinDate()
    {
    	return $this->joinDate;
    }
    
    public function setUpdateDate($val)
    {
    	$this->updateDate = $val;
    }
    
    public function getUpdateDate()
    {
    	return $this->updateDate;
    }
}
