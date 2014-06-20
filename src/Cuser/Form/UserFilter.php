<?php
namespace Cuser\Form;

use Zend\InputFilter\InputFilter;

class UserFilter extends InputFilter
{
	public function __construct()
	{
	$this->add(array(
		'name' => 'username',
		'required' => true,
		'filters' => array(
			array('name' => 'StripTags'),
			array('name' => 'StringTrim'),
		),
		'validators' => array(
			array(
				'name' => 'StringLength',
				'options' => array(
					'encoding' => 'UTF-8',
					'min' => 3,
					'max' => 50,
				),
			),
		),
	));
	
	$this->add(array(
		'name' => 'fullName',
		'required' => false,
		'filters' => array(
			array('name' => 'StripTags'),
			array('name' => 'StringTrim'),
		),
		'validators' => array(
			array(
				'name' => 'StringLength',
				'options' => array(
					'encoding' => 'UTF-8',
					'min' => 10,
					'max' => 50,
				),
			)
		)
	));
	
	$this->add(array(
		'name' => 'password',
		'required' => true,
		'filters' => array(
			array('name' => 'StripTags'),
			array('name' => 'StringTrim'),
		),
		'validators' => array(
			array(
				'name' => 'StringLength',
				'options' => array(
					'encoding' => 'UTF-8',
					'min' => 3,
					'max' => 50,
				),
			)
		)
	));
	
	$this->add(array(
		'name' => 'passwordAgain',
		'required' => true,
		'validators' => array(
			array(
				'name' => 'Identical',
				'options' => array(
					'token' => 'password',
				)
			)
		)
	));
	}
}