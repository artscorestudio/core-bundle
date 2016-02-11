# ASFEntityManager : The embedded entity manager

CoreBundle provides a specific approch for manage entities in the Artscore Studio Framework (ASF). All entities in ASF can be managed by their own entity manager. This can be useful for centralize actions like create new instance of an entity, delete or update entities, etc.

## How to create an entity manager for your entity

Imagine that you have created a bundle called *AcmeUserBundle*. This bundle includes an entity called User :

```php
namespace Acme\UserBundle\Entity;

class User
{
    protected $id;
    
    // [...]
}
```

You want to create a new User after a form submission for example.

```php
namespace Acme\UserBundle\Controller;

use Acme\UserBundle\Entity\User;

class UserController extends Controller
{
    public function createAction()
    {
    	// [...]
    	
    	if ( $form->isValid() ) {  
    		$user = new User();
    		// [...]
    	}
    }
}
```

This approch is not very flexible. Imagine, your entity User is not manage by *AcmeUserBundle* but by another bundle, who extend it. The User entity will not be *Acme\UserBundle\Entity\User* but *ASF\UserBundle\Entity\User*. Worst, the name of the entity is not *User* but *Account* because this is more meaningful... In these cases, you must board on all files refer to this entity.

So after creating your entity, you can declare the manager of that entity in your bundle as follows :

### Step 1 : Declare a service

Declare a service tagged with *asf_core.manager* and with attribute *entity*.
The attribute *entity* can be written in two formats :
* Acme\DemoBundle\Entity\User
* AcmeDemoBundle:User

> Be aware, for the moment, you can manage entities with a name formatted on the [PSR-4 format](http://www.php-fig.org/psr/psr-4/) but with just two sub-namespaces and ended by entity name (like : Acme\DemoBundle\Entity\EntityName).

```xml
<?xml version="1.0" ?>

<container xmlns="http://symfony.com/schema/dic/services"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://symfony.com/schema/dic/services http://symfony.com/schema/dic/services/services-1.0.xsd">

	<parameters>
    	<!-- User Manager -->
		<parameter key="acme_user.user.manager.class">Acme\UserBundle\Entity\Manager\UserManager</parameter>
		<parameter key="acme_user.user.manager.entity.class">Acme\UserBundle\Entity\User</parameter>
	</parameters>

	<services>
		<!-- Entity Manager -->
		<service id="acme_user.user.manager" class="%acme_user.user.manager.class%">
			<tag name="asf_core.manager" entity="%acme_user.user.manager.entity.class%" />
		</service>
	</services>
	
</container>
```

### Step 2 : Use it !

Return in your controller for create User :

```php
namespace Acme\UserBundle\Controller;

class UserController extends Controller
{
    public function createAction()
    {
    	// [...]
    	
    	if ( $form->isValid() ) {  
    		$user = $this->get('acme_user.user.manager')->createInstance();
    		// [...]
    	}
    }
}
```

No hard-coded reference to the entity in your controller, it can be *Acme\DemoBundle\Entity\User* or *ASF\UserBundle\Entity\User*, etc.

### Step 3 (optional) : overriding default entity manager

I don't know if you noticed, but in the examples above, you have not created your own entity manager class. If you want to override the default entity manager, you have just to create the entity manager corresponding to the class name done in the service definition :

```
<parameter key="acme_user.user.manager.class">Acme\UserBundle\Entity\Manager\UserManager</parameter>
```

CoreBundle porvides a Model class to extends if you want :

```php
namespace Acme\UserBundle\Entity\Manager;

use ASF\CoreBundle\Model\Manager\ASFEntityManager;

class UserManager extends ASFEntityManager
{
	// [...]
}
```

