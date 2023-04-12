<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\ZeroOrOne;

/**
 * Testcase class for ZeroOrOne.
 */
class ZeroOrOneTest extends TestCase
{
    public function testZeroOrOne()
    {
        $values = [
            'ZERO' => '0',
            'ONE'  => '1',
        ];
        foreach ($values as $name => $value) {
            $this->assertSame(ZeroOrOne::from($value)->value, $value);
            $this->assertSame(ZeroOrOne::from($value)->name, $name);
        }
    }
}
