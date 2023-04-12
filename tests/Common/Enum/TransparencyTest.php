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
        foreach ($values as $name => $value) {
            $this->assertSame(Transparency::from($value)->value, $value);
            $this->assertSame(Transparency::from($value)->name, $name);
        }
    }
}
