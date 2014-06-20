<?php
namespace Cuser\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CbaseController extends AbstractActionController 
{
	protected $authService;
	protected $identity;
	protected $entityManager;
	protected $userEntity;
	protected $roleEntity;
	
	public function getAuthService()
	{
		if(!$this->authService) {
			$this->authService = $this->getServiceLocator()->get('AuthService');
		}
		return $this->authService;
	}
	
	public function getIdentity()
	{
		if (!$this->identity) {
			$this->identity = $this->getAuthService()->getStorage()->read();
		}
		return $this->identity;
	}
	
	public function getEntityManager()
	{
		if (!$this->entityManager) {
			$this->entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		}
		return $this->entityManager;
	}
	
	public function getRole($id = 1)
	{
		return $this->getEntityManager()->find('Cuser\Entity\Role',$id);
	}
	
	public function getUserEntity()
	{
		if (!$this->userEntity) {
			$this->userEntity = $this->getServiceLocator()->get('Cuser\Entity\User');
		}
		return $this->userEntity;
	}
}