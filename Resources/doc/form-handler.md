# ASFCoreBundle Form Handler Model

According to the [Symfony documentation on best partices for forms](http://symfony.com/doc/current/best_practices/forms.html#handling-form-submits), handling form submits have to be in the same controller action for rendering the form and handling it. However, it may happen that the handling of the form is consistent. This is why CoreBundle provides a model class *FormHandlerModel* to outsource the processing of the form in a specific class.

For reasons of clarity, if you need to create this class, it is recommended to create it in fodler *Form/Handler/*.

```php
namespace Acme\DemoBundle\Form\Handler;

use ASF\CoreBundle\Form\Handler\FormHandlerModel;

class TaskFormHandler extends FormHandlerModel
{
	/**
	 * (non-PHPdoc)
	 * @see \Asf\ApplicationBundle\Application\Form\FormHandlerModel::processForm()
	 * @throw \Exception
	 */
	public function processForm($model)
	{
		// [...]
	}
}

You have one abstract method : *processForm* who pass the entity of the form. Ti's up to you to do the rest.