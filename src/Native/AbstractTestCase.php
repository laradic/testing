<?php
/**
 * Part of the Laradic PHP packages.
 *
 * License and copyright information bundled with this package in the LICENSE file
 */
namespace Laradic\Testing\Native;


use Laradic\Testing\Native\Traits\PHPUnitTrait;

abstract class AbstractTestCase extends \PHPUnit_Framework_TestCase
{
    use PHPUnitTrait;

    public function testTest()
    {
        static::assertTrue(true);
    }
}