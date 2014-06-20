<?php
namespace Cuser\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
class Role
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;
    
    /** @ORM\Column(type="string") */
    protected $name;
    
    /** @ORM\Column(type="string") */
    protected $description;
    
    public function setName($val)
    {
        $this->name = $val;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setDescription($val)
    {
    	$this->description = $val;
    }
    
    public function getDescription()
    {
    	return $this->description;
    }
} 
