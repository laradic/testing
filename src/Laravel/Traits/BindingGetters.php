<?php
/**
 * Part of the Laradic PHP packages.
 *
 * MIT License and copyright information bundled with this package in the LICENSE file
 */
namespace Laradic\Testing\Laravel\Traits;

/**
 * This is the BindingGetters trait.
 *
 * @package   Laradic\Testbench
 * @author    Laradic Dev Team
 * @copyright Copyright (c) 2015, Laradic
 * @license   https://tldrlegal.com/license/mit-license MIT License
 */
trait BindingGetters
{
    /**
     * @return \Illuminate\Filesystem\Filesystem
     */
    protected function getFiles()
    {
        return $this->app->make('files');
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
