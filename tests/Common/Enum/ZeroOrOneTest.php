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
        foreach ($values as $enum => $value) {
            $this->assertSame(ZeroOrOne::$enum()->getValue(), $value);
        }
    }
}
