<?php
/**
 * Part of the Laradic PHP packages.
 *
 * MIT License and copyright information bundled with this package in the LICENSE file
 */
namespace Laradic\Testing\Laravel\Traits;

trait BindingGetters
{
    /**
     * @return \Illuminate\Filesystem\Filesystem
     */
    protected function getFiles()
    {
        return $this->app->make('files');
    }

    /**
     * getFs method
     * @return \Illuminate\Filesystem\Filesystem
     */
    protected function getFs()
    {
        return $this->getFiles();
    }

    /** @return \Illuminate\Config\Repository */
    protected function getConfig()
    {
        return $this->app->make('config');
    }

    /** @return \Illuminate\Contracts\Console\Kernel */
    protected function getKernel()
    {
        return $this->app->make('Illuminate\Contracts\Console\Kernel');
    }
}
