<?php namespace Viocon;

class ContainerTest extends \PHPUnit_Framework_TestCase
{
    protected static $container;

    public static function setupBeforeClass()
    {
        static::$container = new Container();
    }

    public function testTheHell()
    {
        $this->assertTrue(true);
    }

    public function testBuildWithClassNameAsKey()
    {
        $stdClass = static::$container->build('\\stdClass');
        $this->assertInstanceOf('\\stdClass', $stdClass);
    }

    public function testSetAndBuild()
    {
        static::$container->set('myStdClass', '\\stdClass');
        $stdClass = static::$container->build('myStdClass');
        $this->assertInstanceOf('\\stdClass', $stdClass);
    }

    public function testSingleton()
    {
        $container = static::$container;
        $container->singleton('mySingleton', '\\stdClass');
        $this->assertInstanceOf('\\stdClass', $container->build('mySingleton'));
    }

    public function testSingletonWithPersistence()
    {
        $container = new Container();
        $container->singleton('mySingleton', '\\stdClass');
        $stdClass = $container->build('mySingleton');
        $stdClass->testVar = 'value';

        $stdClass2 = $container->build('mySingleton');
        $this->assertEquals('value', $stdClass2->testVar);
    }
}