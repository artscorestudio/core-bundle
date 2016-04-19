<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\CoreBundle\Form\Handler;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

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
	 * @var Request
	 */
	protected $request;
	
	/**
	 * @var mixed
	 */
	protected $model;
	
	/**
	 * @param FormTypeInterface $form
	 */
	public function __construct($form, $request)
	{
		$this->form = $form;
		$this->request = $request;
	}

	/**
	 * {@inheritDoc}
	 * @see \ASF\CoreBundle\Form\Handler\FormHandlerInterface::getForm()
	 */
	public function getForm()
	{
	    return $this->form;
	}
	
	/**
	 * {@inheritDoc}
	 * @see \ASF\CoreBundle\Form\Handler\FormHandlerInterface::setForm()
	 */
	public function setForm($form)
	{
	    $this->form = $form;
	    return $this;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\CoreBundle\Form\Handler\FormHandlerInterface::process()
	 */
	public function process()
	{
		$this->form->handleRequest($this->request);
		$this->model = $this->form->getData();
		return ($this->form->isSubmitted() && $this->form->isValid() && $this->processForm($this->model));
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\CoreBundle\Form\Handler\FormHandlerInterface::processForm()
	 */
	abstract function processForm($model);
}