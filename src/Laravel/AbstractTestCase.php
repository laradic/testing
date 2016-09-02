<?php
/**
 * Part of the Laradic PHP packages.
 *
 * License and copyright information bundled with this package in the LICENSE file
 */


namespace Laradic\Testing\Laravel;



use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Laradic\Testing\Laravel\Traits\BindingGetters;
use Laradic\Testing\Laravel\Traits\TestHelpers;
use Laradic\Testing\Native\Traits\PHPUnitTrait;

/**
 * This is the AbstractTestCase.
 *
 * @author         Laradic Dev Team
 * @copyright      Copyright (c) 2015, Laradic
 * @license        https://tldrlegal.com/license/mit-license MIT License
 * @property \Illuminate\Foundation\Application $app
 */
abstract class AbstractTestCase extends OrchestraTestCase
{

    use PHPUnitTrait, TestHelpers, BindingGetters;

    abstract protected function getPackageRootPath();

    /**
     * getServiceProviderClass
     *
     * @return \Laradic\ServiceProvider\ServiceProvider
     */
    abstract protected function getServiceProviderClass();

    protected function isProviderRegisterd($providerClass)
    {
        return in_array($providerClass, $this->app->getLoadedProviders(), true);
    }

    /**
     * registerServiceProvider
     *
     * @return \Laradic\ServiceProvider\ServiceProvider
     */
    protected function registerServiceProvider()
    {
        $class = $this->getServiceProviderClass();
        /** @var \Laradic\ServiceProvider\ServiceProvider $provider */
        return $this->app->register($class);
    }

    /**
     * getProvider
     *
     * @return \Laradic\ServiceProvider\ServiceProvider|\Illuminate\Support\ServiceProvider|null
     */
    protected function getServiceProvider()
    {
        $this->registerServiceProvider();
        return $this->app->getProvider($this->getServiceProviderClass());
    }



    protected function getPackagePath($path = null)
    {
        return null === $path ? $this->getPackageRootPath() : $this->getPackageRootPath() . DIRECTORY_SEPARATOR . $path;
    }

    protected function getPackageConfig()
    {
        return $this->getServiceProvider()->pathsToPublish(null, 'config');
    }

    protected function getPackageFile($path)
    {
        $this->getFiles()->get($this->getPackagePath($path));
    }

    /**
     * Executes a kernel command
     *
     * @param string $command
     */
    protected function command($command)
    {
        $this->getKernel()->call($command);
    }

    /**
     * Setup the application environment.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $config = $app->make('config');
        $config->set('cache.driver', 'array');
        $config->set('app.key', 'sG7qHHCc0jAseXbQx5BEv8DiZn4x7p4C');
        $config->set('database.default', 'sqlite');
        $config->set(
            'database.connections.sqlite',
            [
                'driver'   => 'sqlite',
                'database' => ':memory:',
                'prefix'   => '',
            ]
        );
        $config->set('mail.driver', 'log');
        $config->set('session.driver', 'array');


        #$app->call('command.migrate');
        # $app->make('mailer')->pretend(true);
    }

    /**
     * createTestingEnv
     *
     * @param $dir
     */
    protected function createTestingEnv($dir)
    {
        /** @var \Illuminate\Foundation\Application $app */
        $app     = $this->app;
        $baseDir = base_path($dir);

        $app->bind('path.public', function () use ($baseDir) {
            return $baseDir . '/public';
        });

        $app->bind('path.base', function () use ($baseDir) {
            return $baseDir;
        });


        $app->bind('path.storage', function () use ($baseDir) {
            return $baseDir . '/storage';
        });

        $app->flush();
    }

    protected function writeToCLI($var)
    {
        fwrite(STDERR, print_r($var, true));
    }
}
