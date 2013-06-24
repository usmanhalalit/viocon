# Viocon
A simple and flexible IoC or Service container for PHP.

It can be extremely helpful to decouple your dependencies. You can also mock dependencies at runtime.

## Installation

Viocon uses [Composer](http://getcomposer.org/) to make things easy.

Learn to use composer and add this to require (in your composer.json):

    "usmanhalalit/viocon": "dev-master"

Library on [Packagist](https://packagist.org/packages/usmanhalalit/viocon).

## Usage
```PHP
$container = new \Viocon\Container();
```
___

### Bind a closure
```PHP
$container->set('myClosure', function ($test1, $test2) 
{
    $stdClass = new \stdClass();
    $stdClass->testVar1 = $test1;
    $stdClass->testVar2 = $test2;
    $stdClass->testMethod = function ($test3) {
        return $test3;
    };

    return $stdClass;
});

$object = $container->build('myClosure', array('Test Var 1', 'Test Var 2'))

echo $object->testVar1;

```

### Build Any Class and Optionally Pass Parameters
```PHP
$container->build('\PDO', array('myConnectionInfo'));

```

### Singleton

```PHP
$container->set('mySingleton', '\\stdClass');
$stdClass = $container->build('mySingleton');
```

### Replacing Objects at Runtime
It can be useful while testing with mocked object
```PHP
$mockedClass = new \stdClass();
$mockedClass->testVar = 'mocked';

static::$container->setInstance('\\stdClass', $mockedClass);

$stdClass = static::$container->build('\\stdClass');
$this->assertEquals('mocked', $stdClass->testVar);
```