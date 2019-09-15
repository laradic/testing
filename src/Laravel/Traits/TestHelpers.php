<?php
/*
 * (c) Graham Campbell <graham@alt-three.com>
 */
namespace Laradic\Testing\Laravel\Traits;

use Exception;
use Mockery;

/**
 * This is the mockery trait.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
trait TestHelpers
{
    /**
     * Setup the test case.
     *
     * @return void
     */
    public function setUp():void
    {
        parent::setUp();

        $this->start();
    }

    /**
     * Run extra setup code.
     *
     * @return void
     */
    protected function start()
    {
        // call more setup methods
    }

    /**
     * Tear down the test case.
     *
     * @return void
     */
    public function tearDown():void
    {
        $this->finish();

        parent::tearDown();

        if ( $container = Mockery::getContainer() ) {
            $this->addToAssertionCount($container->mockery_getExpectationCount());
        }

        Mockery::close();
    }

    /**
     * Run extra tear down code.
     *
     * @return void
     */
    protected function finish()
    {
        // call more tear down methods
    }

    /**
     * Assert that a class can be automatically injected.
     *
     * @param string $name
     *
     * @return void
     */
    public function assertIsInjectable($name)
    {
        $injectable = true;
        $message    = "The class '$name' couldn't be automatically injected.";
        try {
            $class = $this->makeInjectableClass($name);
            static::assertInstanceOf($name, $class->getInjectedObject());
        }
        catch (Exception $e) {
            $injectable = false;
            if ( $msg = $e->getMessage() ) {
                $message .= " $msg";
            }
        }
        static::assertTrue($injectable, $message);
    }

    /**
     * Register and make a stub class to inject into.
     *
     * @param string $name
     *
     * @return object
     */
    protected function makeInjectableClass($name)
    {
        do {
            $class = 'testBenchStub' . str_random();
        }
        while ( class_exists($class) );
        eval("
            class $class
            {
                protected \$object;
                public function __construct(\\$name \$object)
                {
                    \$this->object = \$object;
                }
                public function getInjectedObject()
                {
                    return \$this->object;
                }
            }
        ");
        return $this->app->make($class);
    }
}
