<?php 
namespace Cuser\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Doctrine\ORM\EntityManager;

class UserForm extends Form
{
	public function __construct (EntityManager $entityManager)
	{
		parent::__construct();
		
		$this->add(array(
			'name'	=> 'id',
			'type'	=>	'hidden',
		));
		
		$this->add(array(
			'name'	=> 'username',
			'type'	=>	'Text',
			'attributes' => array(
				'required' => 'required',
				'class' => 'form-control',
			),
			'options' => array(
				'label' => 'Username',
			),
		));
		
		$this->add(array(
			'name'	=> 'fullName',
			'type'	=>	'Text',
			'attributes' => array(
				'class' => 'form-control',
			),
			'options' => array(
				'label' => 'Full Name',
			),
		));
		
		$this->add(array(
			'name'	=> 'password',
			'type'	=>	'Password',
			'attributes' => array(
				'required' => 'required',
				'class' => 'form-control',
			),
			'options' => array(
				'label' => 'Password',
			),
		));
		
		$this->add(array(
			'name'	=> 'passwordAgain',
			'type'	=>	'Password',
			'attributes' => array(
				'required' => 'required',
				'class' => 'form-control',
			),
			'options' => array(
				'label' => 'Again',
			),
		));
		
		$this->add(array(
			'name' => 'email',
			'type' => 'Email',
			'attributes' => array(
				'required' => 'required',
				'class' => 'form-control',
			),
			'options' => array(
				'label' =>'Email',
			),
		));
		$this->add(array(
			'type' => 'DoctrineModule\Form\Element\ObjectSelect',
			'name' => 'role',
			'options' => array(
				'label' => 'Role',
				'object_manager' => $entityManager,
				'target_class'   => '\Cuser\Entity\Role',
				'property'       => 'name',
				'empty_option'   => '--- please choose ---',
				'is_method'      => true,
			),
			'attributes' => array(
				'class' => 'form-control',
			)
		));
		$this->add(new Element\Csrf('security'));
		$this->add(array(
			'name' => 'submit',
			'attributes' => array(
				'type' => 'submit',
				'class' => 'btn btn-primary',
				'value' => 'Register',
			),
		));
	}	
}
