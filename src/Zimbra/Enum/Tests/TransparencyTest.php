<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\Transparency;

/**
 * Testcase class for Transparency.
 */
class TransparencyTest extends PHPUnit_Framework_TestCase
{
    public function testTransparency()
    {
         $values = [
            'OPAQUE'      => 'O',
            'TRANSPARENT' => 'T',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(Transparency::$enum()->value(), $value);
        }
    }
}
