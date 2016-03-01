<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\IpType;

/**
 * Testcase class for IpType.
 */
class IpTypeTest extends PHPUnit_Framework_TestCase
{
    public function testIpType()
    {
        $values = [
            'IPV4' => 'ipV4',
            'IPV6' => 'ipV6',
            'BOTH' => 'both',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(IpType::$enum()->value(), $value);
        }
    }
}
