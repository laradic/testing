<?php
/**
 * Part of the CLI PHP packages.
 *
 * License and copyright information bundled with this package in the LICENSE file
 */

namespace Laradic\Testing\Laravel\Traits;

use Illuminate\Container\Container;
use Illuminate\Support\Facades\Facade;
use Mockery as m;

trait ContainerMocks
{
    /** @var \Illuminate\Container\Container */
    protected $app;

    /**
     * Setup.
     *
     * @return void
     */
    public function setUpContainerMocks($addContainer = true)
    {
        if($addContainer) {
            // IoC Container
            $this->app = new Container;
        }
        // IoC Bindings
        $this->app['alerts']     = m::mock('Cartalyst\Alerts\Alerts');
        $this->app['cache']      = m::mock('Illuminate\Cache\CacheManager');
        $this->app['config']     = m::mock('Illuminate\Config\Repository');
        $this->app['datagrid']   = m::mock('Cartalyst\DataGrid\DataGrid');
        $this->app['events']     = m::mock('Illuminate\Events\Dispatcher');
        $this->app['files']      = m::mock('Illuminate\Filesystem\Filesystem');
        $this->app['redirect']   = m::mock('Illuminate\Routing\Redirector');
        $this->app['request']    = m::mock('Illuminate\Http\Request');
        $this->app['sentinel']   = m::mock('Cartalyst\Sentinel\Sentinel');
        $this->app['session']    = m::mock('Illuminate\Session\SessionManager');
        $this->app['translator'] = m::mock('Illuminate\Translation\Translator');
        $this->app['url'] = $this->app['Illuminate\Contracts\Routing\UrlGenerator'] = m::mock('Illuminate\Routing\UrlGenerator');
        $this->app['validator']  = m::mock('Illuminate\Validation\Factory');
        $this->app['view'] = $this->app['Illuminate\Contracts\View\Factory'] = m::mock('Illuminate\View\Factory');
        $this->app['response'] = $this->app['Illuminate\Contracts\Routing\ResponseFactory'] = m::mock('Symfony\Component\HttpFoundation\Response');

        // Configurations
        $this->app['config']->shouldIgnoreMissing();

        // Set the container instance
        Container::setInstance($this->app);

        // Set the facade container
        Facade::setFacadeApplication($this->app);
    }

    /**
     * Set trans expectation.
     *
     * @param  int  $times
     * @return this
     */
    protected function trans($times = 1)
    {
        $this->app['translator']->shouldReceive('trans')
            ->times($times);

        return $this;
    }

    /**
     * Set a redirect method expectation.
     *
     * @param  $method  string
     * @return this
     */
    protected function redirect($method)
    {
        $this->app['redirect']->shouldReceive($method)
            ->once()
            ->andReturn($this->app['redirect']);

        return $this;
    }
}