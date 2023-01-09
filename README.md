# Inject-Mocks

[![Tests](https://github.com/silasyudi/inject-mocks/actions/workflows/tests.yml/badge.svg)](https://github.com/silasyudi/inject-mocks/actions/workflows/tests.yml)
[![Maintainability](https://api.codeclimate.com/v1/badges/b89bc606334c7edec92e/maintainability)](https://codeclimate.com/github/silasyudi/inject-mocks/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/b89bc606334c7edec92e/test_coverage)](https://codeclimate.com/github/silasyudi/inject-mocks/test_coverage)

Automatic injection of mocks into test subjects via @InjectMocks and @Mock annotations, to speed up unit testing with
PHPUnit.

## Summary

- [Language / Idioma](#language--idioma)
- [Instalation](#instalation)
- [Requirements](#requirements)
- [Features](#features)
- [Usage](#usage)

## Language / Idioma

Leia a versão em português :brazil: [aqui](README_PT_BR.md).

## Instalation

To install in the development environment:

```sh
composer require --dev silasyudi/inject-mocks
```

## Requirements

- PHP 7.4+
- Composer

## Features

Using @InjectMocks and @Mock annotations in test classes you can automatically inject mocks into test subjects.

In a typical scenario, we would do it like this:

### Example without @InjectMocks/@Mock:

```php
class SomeTest extends \PHPUnit\Framework\TestCase
{
    public void testSomething() 
    {
        $someDependency = $this->createMock(Dependency::class);    
        $anotherDependency = $this->createMock(AnotherDependency::class);
        ...
        $subject = new Service($someDependency, $anotherDependency, ...);
        ...    
    }
    
    ...
```

This approach brings the difficulty of maintenance, because if the test subject is changed, either by adding, decreasing
or replacing the dependencies, you will have to change it in each test.

With the @InjectMocks/@Mock annotations, we abstract these test subject changes. Example:

### Example with @InjectMocks/@Mock:

```php
use SilasYudi\InjectMocks\InjectMocks;
use SilasYudi\InjectMocks\Mock;
use SilasYudi\InjectMocks\MockInjector;

class SomeTest extends \PHPUnit\Framework\TestCase
{
    /** @Mock */
    private Dependency $someDependency;
    /** @Mock */
    private AnotherDependency $anotherDependency;
    
    ...
    
    /** @InjectMocks */
    private Service $subject;
    
    public function setUp() : void 
    {
        MockInjector::inject($this);
    }
    
    public void testSomething()
    {
        // $this->subject e as dependências já estão instanciadas.
    }
    
    ...
```

## Usage

As in the example in the previous topic, the @InjectMocks annotation must be placed on the property of the test subject
that you want to test, and the @Mock annotation must be placed on the properties corresponding to the dependencies that
you want to mock or inject.

After that, run the injector service with the sentence `MockInjector::inject($this)`. This execution can be declared in
each test or in `setUp`.

After executing the injector, the `service` annotated with @InjectMocks will be a real instance available in the scope
of the test class, and each dependency annotated with @Mock will be an instance of MockObject, injected into the test
subject via the constructor, and will also be available in the scope of the test class.

### Details

#### 1. Scope of Annotations

- Both @InjectMocks and @Mock MUST be placed over a TYPED property in a TestCase class;
- Properties that receive @InjectMocks and @Mock annotations MUST be an object;
- You MUST use only one @InjectMocks annotation per TestCase. When using more than one on the same scope, this library
  will use only the first one, and ignore the others;
- You MUST use a @Mock annotation for each test subject dependency you want to mock;
- Using annotations on untyped properties or on primitive types will cause a `MockInjectException` exception.
- When using @Mock on more than one object of the same type in the same test class, this library will match each one
  via property names, which MUST be identical to the test subject class.

#### 2. Behaviors

@InjectMocks and @Mock work independently and alone, or together. Details about each one:

##### 2.1. @InjectMocks

It will create a real instance through the constructor, and if there are parameters in the constructor, the following
value will be used in each parameter, in this order:

- A `mock` created from the @Mock annotation, if one exists;
- The `default` value if it is an optional parameter;
- `null` if it is typed as `null`;
- Will create a `mock` if it is not a primitive type. In this case, this `mock` will not be injected in the TestCase
  scope;
- Finally, if the previous options are not satisfied, it will throw `MockInjectException` exception.

Obs.: You can use @Mock annotation on all, some or none of the test subject's dependencies.

##### 2.2. @Mock

Will create a `mock` injected into the TestCase scope, without using the constructor. This creation behavior is
identical to `TestCase::createMock()`.
