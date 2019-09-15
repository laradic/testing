<?php
/**
 * Part of the Laradic PHP packages.
 *
 * License and copyright information bundled with this package in the LICENSE file
 */
namespace Laradic\Testing\Native;


use Laradic\Testing\Native\Traits\PHPUnitTrait;

abstract class AbstractTestCase60 extends \PHPUnit\Framework\TestCase
{
    use PHPUnitTrait;

    public function testTest()
    {
        static::assertTrue(true);
    }
}
