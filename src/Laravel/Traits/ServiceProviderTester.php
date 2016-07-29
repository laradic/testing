<?php
/*
 * (c) Graham Campbell <graham@alt-three.com>
 */
namespace Laradic\Testing\Laravel\Traits;


use Illuminate\Support\ServiceProvider;
use ReflectionClass;
use Laradic\Testing\Util;

/**
 * This is the ServiceProviderTester.
 *
 * @package        Laradic\Testbench
 * @author         Laradic Dev Team
 * @copyright      Copyright (c) 2015, Laradic
 * @license        https://tldrlegal.com/license/mit-license MIT License
 * @mixin \Laradic\Testing\Laravel\AbstractTestCase
 */
trait ServiceProviderTester
{

    abstract protected function getServiceProviderClass();

    public function testIsAServiceProvider()
    {
        $class = $this->getServiceProviderClass();

        $reflection = new ReflectionClass($class);

        $serviceprovider = new ReflectionClass('Illuminate\Support\ServiceProvider');

        $msg = "Expected class '$class' to be a service provider.";

        static::assertTrue($reflection->isSubclassOf($serviceprovider), $msg);
    }

    public function testProvides()
    {
        $class      = $this->getServiceProviderClass();
        $reflection = new ReflectionClass($class);

        $method = $reflection->getMethod('provides');
        $method->setAccessible(true);

        $msg = "Expected class '$class' to provide a valid list of services.";
        static::assertInternalType('array', $method->invoke(new $class($this->app)), $msg);
    }

    public function runServiceProviderRegisterTest($class)
    {
        $this->app->register($class);
        $providers = $this->app->getLoadedProviders();
        #var_dump($providers);

        static::assertArrayHasKey($class, $providers);
        static::assertTrue($providers[ $class ]);
    }

    public function runServiceProviderPublishesConfigTest(array $configFiles = [])
    {
        $publishesConfigFiles = ServiceProvider::pathsToPublish(null, 'config');
        $configFileNames      = [ ];
        foreach ($publishesConfigFiles as $configFileFrom => $configFileTo) {
            $configFileNames[] = Util::getFilenameWithoutExtension($configFileFrom);
        }
        foreach ($configFiles as $configFile) {
            static::assertInArray($configFile, $configFileNames);
        }
        #$class::
    }


}
