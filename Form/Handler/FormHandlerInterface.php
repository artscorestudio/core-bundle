<?php
/**
 * This file is part of Artscore Studio Framework
 *
 * (c) 2012-2013 Nicolas Claverie <info@artscore-studio.fr>
 *
 * This source file is subject to the MIT Licence that is bundled
 * with this source code in the file LICENSE.
 */
namespace ASF\CoreBundle\Form\Handler;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Form Handler Model
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
interface FormHandlerInterface
{
	/**
	 * @return \Symfony\Component\Form\FormInterface
	 */
	public function getForm();
	
	/**
	 * @param FormInterface $form
	 * @return \Asf\Bundle\ApplicationBundle\Application\Form\FormHandlerInterface
	 */
	public function setForm($form);
	
	/**
	 * @return \Symfony\Component\HttpFoundation\RequestStack
	 */
	public function getRequest();
	
	/**
	 * @param RequestStack $request
	 * @return \Asf\Bundle\ApplicationBundle\Application\Form\FormHandlerInterface
	 */
	public function setRequest($request);
	
	/**
	 * @return \Symfony\Component\Translation\Translator
	 */
	public function getTranslator();
	
	/**
	 * @param Translator $translator
	 * @return \Asf\Bundle\ApplicationBundle\Application\Form\FormHandlerInterface
	 */
	public function setTranslator($translator);
	
	/**
	 * @return TokenStorage
	 */
	public function getTokenStorage();
	
	/**
	 * @param TokenStorageInterface $token_storage
	 */
	public function setTokenStorage($token_storage);
	
	/**
	 * @return AuthorizationCheckerInterface
	 */
	public function getAuthorizationChecker();
	
	/**
	 * @param AuthorizationCheckerInterface $authorization_checker
	 */
	public function setAuthorizationChecker($authorization_checker);
	
	/**
	 * Process Form
	 * 
	 * @return boolean
	 */
	public function process();
	
	/**
	 * This method must define the process logic for the entity (saving data process, etc.)
	 * 
	 * @param mixed $model 
	 * @return boolean
	 */
	public function processForm($model);
}