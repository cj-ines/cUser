<?php
namespace Cuser\Form;

use Zend\Form\Form;
use Zend\Element\Element;

class LoginForm extends  Form
{
	
	public function __construct()
	{
		parent::__construct();
		
		$this->setAttribute('method','POST');
		
		$this->add(array(
			'name' => 'username',
			'type' => 'text',
			'attributes' => array(
				'class' => 'form-control',
				'required' => 'required',
			),
			'options' => array(
				'label' => 'Username'
			),
		));
		
		$this->add(array(
			'name' => 'password',
			'type' => 'password',
			'attributes' => array(
				'class' => 'form-control',
				'required' => 'required',
			),
			'options' => array(
				'label' => 'Password'
			),
		));
		
		$this->add(array(
			'name' => 'login',
			'type' => 'submit',
			'attributes' => array(
				'value' => 'Login',
				'class' => 'btn btn-primary'
			)
		));
	}
}