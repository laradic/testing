<?php
/**
 * Part of the Laradic PHP Packages.
 * Copyright (c) 2018. Robin Radic.
 * The license can be found in the package and online at https://laradic.mit-license.org.
 *
 * @copyright Copyright 2018 (c) Robin Radic
 * @license   https://laradic.mit-license.org The MIT License
 */

namespace Laradic\Testing\Native;


use Laradic\Testing\Native\Traits\WithFaker;

abstract class AbstractTestCase extends \PHPUnit\Framework\TestCase
{
    use WithFaker;

    public function testTest()
    {
        static::assertTrue(true);
    }
}
