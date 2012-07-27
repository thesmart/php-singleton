Singleton PHP Library by John Smart ([@thesmart](https://github.com/thesmart))
==========================

A simple Singleton pattern, with optional support for named instances.

Example:

	MyClass::setInstance(new MyClass());
	$myClass = Singleton::getInstance();
	$has = SingletonMock::hasInstance();

Named instances:

	SingletonMock::setInstance($myClass, 'foobar');
	$myClass = Singleton::getInstance('foobar');
	$has = SingletonMock::hasInstance('foobar');

# Like this project?

Check out my others.
[@thesmart](https://twitter.com/thesmart)