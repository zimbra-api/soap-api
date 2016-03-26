<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\GranteeType;

/**
 * Testcase class for GranteeType.
 */
class GranteeTypeTest extends PHPUnit_Framework_TestCase
{
    public function testGranteeType()
    {
        $values = [
            'USR'   => 'usr',
            'GRP'   => 'grp',
            'EGP'   => 'egp',
            'ALL'   => 'all',
            'DOM'   => 'dom',
            'EDOM'  => 'edom',
            'GST'   => 'gst',
            'KEY'   => 'key',
            'PUB'   => 'pub',
            'EMAIL' => 'email',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(GranteeType::$enum()->value(), $value);
        }
    }
}
