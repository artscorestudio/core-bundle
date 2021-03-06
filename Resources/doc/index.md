# Artscore Studio Core Bundle

Symfony 2/3 core bundle for commons features in Artscore Studio Framework Environment.

> IMPORTANT NOTICE: This bundle is still under development. Any changes will be done without prior notice to consumers of this package. Of course this code will become stable at a certain point, but for now, use at your own risk.

## Prerequisites

This version of the bundle requires :
* [Symfony 2.8+ LTS / 3.0+][1]

### Translations

If you wish to use default texts provided in this bundle, you have to make sure you have translator enabled in your config.

```yaml
# app/config/config.yml
framework:
    translator: ~
```

For more inforamtion about translations, check [Symfony documentation][2].

## Installation

### Step 1 : Download ASFCoreBundle using composer

Require the bundle with composer :

```bash
$ composer require artscorestudio/core-bundle "dev-master"
```

Composer will install the bundle to your project's *vendor/artscorestudio/core-bundle* directory.

### Step 2 : Enable the bundle

Enable the bundle in the kernel :

```php
// app/AppKernel.php

public function registerBundles()
{
	$bundles = array(
		// ...
		new ASF\CoreBundle\ASFCoreBundle()
		// ...
	);
}
```

### Next Steps

Now you have completed the basic installation and configuration of the ASFCoreBundle, you are ready to learn about more advanced features and usages of the bundle.

The following documents are available :

* [What is Artscore Studio Framework][3]
* [ASFCoreBundle Form Handler Model][4]
* [ASFManager : A way for centralize actions on an entity][5]

[1]: https://symfony.com/download
[2]: https://symfony.com/doc/current/book/translation.html
[3]: framework.md
[4]: form-handler.md
[5]: asf-manager.md