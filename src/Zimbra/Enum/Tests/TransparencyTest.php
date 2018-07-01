<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\Transparency;

/**
 * Testcase class for Transparency.
 */
class TransparencyTest extends TestCase
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
