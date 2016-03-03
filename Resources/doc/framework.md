# Artscore Studio Framework

Artscore Studio Framework is my personal environment for developping applications with Symfony. This framework is personal, it is not intended to be proposed for routine business use. You can use it however you like as it is under MIT License.

> IMPORTANT NOTICE: This framework is still under development. Any changes will be done without prior notice to consumers of this package. Of course this code will become stable at a certain point, but for now, use at your own risk.

## The goal of Artscore Studio Framework

The purpose of this framework is to provide reusable bundles in Artscore Studio Framework environment. There are two types of bundles in Artscore Symfony Framework Studio :

* bundles : All bundle, by defaultn are dependent to Artscore Studio Framework and mainly ASFCoreBundle. These bundles were therefore not intended to be used outside the Artscore Studio Framework environment.
* Component :  With the development of the bundles, some of them become Components. These bundles are completely usable outside the Framework environment.

## The versioning system

I set up a method of versioning to navigate. Nothing revolutionary, but it is important to define it.

A version number will consist of a series of numbers separated by dots. The numbers are ordered from most significant to least significant: an evolution of the first number is a recasting (relative) of the bundle, while the latter corresponds to a minor evolution.

So, the version number policy is : *x.y.z*, with :

* **x** : Major version. This is incremented when major changes are made in the bundle.
* **y** : This is incremented when a new feature is added but not revolutionnary the entire bundle mechanism.
* **z** : This number is incremented when corrections are made on the existing.

### Bundle under development : branch 0.y.z

The version number of the first development phase will be a little different from the common numbering. At first, when creating a bundle until the developer believes that it represents a logical and stable unit, the bundle will remain under the original branch: *dev-master*.

After that, the bundle is considered to be used in a project. However, it may be in a phase where the major developments arrive regularly. This phase represent a bundle still under developement but can be used has this. In this case, the version number of policy will be strat by **0.y.z**.

So, the version number policy for a bundle under development is : *0.y.z*, with :

* **x** : Major version.
* **y** : This is incremented when a new feature is added
* **z** : This number is incremented when corrections are made on the existing.

### Bundle usable in stable version : branch 1.y.z and up

When the developer believes that the bundle is now in a stable release, the bundle leaves the *0.y.z* branch and can now increment the major version number.

So, the version number policy for a stable bundle is : *1.y.z*, with :

* **x** : Major version. This is incremented when major changes are made in the bundle.
* **y** : This is incremented when a new feature is added but not revolutionnary the entire bundle mechanism.
* **z** : This number is incremented when corrections are made on the existing.

### How to work with versioning

The golden rule is : never work on the default branch (branch master) when the bundle is spent in production. So when you get into developing a bundle, create a development branch.

Example : ASFCoreBundle is available in v1.0.0. So, it is in production. We want to add new feature on it, so we create a branch : v1.1.0, because this is a new feature (see above). With your favorite Git client, you create new branch : 1.1.0. This branch is in dev so if you add it in composer.json file, you have to call the bundle like this :

```bash
$ composer require artscorestudio/core-bundle "1.1.0@dev"
``` 

When the work is finished, you can merge the branch 1.1.0 into master branch and create a tag on master branch 1.1.0. In production, if we want to use this new version, add it in composer.json like this :

```bash
$ composer require artscorestudio/core-bundle "1.1.0"
```

Version constraints can be specified in several ways, read [Composer Documentation](https://getcomposer.org/doc/articles/versions.md) for more in-depth information on this topic.