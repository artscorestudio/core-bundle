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
use Symfony\Component\Translation\Translator;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Form Handler Model
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
abstract class FormHandlerModel implements FormHandlerInterface
{
	/**
	 * @var FormInterface
	 */
	protected $form;
	
	/**
	 * @var mixed
	 */
	protected $model;
	
	/**
	 * @param FormTypeInterface $form
	 */
	public function __construct(FormInterface $form)
	{
		$this->form = $form;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Asf\Bundle\ApplicationBundle\Application\Form\FormHandlerInterface::getForm()
	 */
	public function getForm()
	{
		return $this->form;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Asf\Bundle\ApplicationBundle\Application\Form\FormHandlerInterface::setForm()
	 */
	public function setForm($form)
	{
		$this->form = $form;
		return $this;
	}

	/**
	 * (non-PHPdoc)
	 * @see \Asf\Bundle\ApplicationBundle\Application\Form\FormHandlerInterface::process()
	 */
	public function process()
	{
		$this->form->handleRequest($this->request);
		$this->model = $this->form->getData();
		return ($this->form->isSubmitted() && $this->form->isValid() && $this->processForm($this->model));
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Asf\Bundle\ApplicationBundle\Application\Form\FormHandlerInterface::processForm()
	 */
	abstract function processForm($model);
}