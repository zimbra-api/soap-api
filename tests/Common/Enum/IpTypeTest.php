<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\IpType;

/**
 * Testcase class for IpType.
 */
class IpTypeTest extends TestCase
{
    public function testIpType()
    {
        $values = [
            'IPV4' => 'ipV4',
            'IPV6' => 'ipV6',
            'BOTH' => 'both',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(IpType::$enum()->getValue(), $value);
        }
    }
}
