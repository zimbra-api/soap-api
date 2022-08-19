<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\Transparency;

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
        foreach ($values as $enum => $value) {
            $this->assertSame(Transparency::$enum()->getValue(), $value);
        }
    }
}
