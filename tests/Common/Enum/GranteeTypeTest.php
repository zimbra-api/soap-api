<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\GranteeType;

/**
 * Testcase class for GranteeType.
 */
class GranteeTypeTest extends TestCase
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
        foreach ($values as $enum => $value) {
            $this->assertSame(GranteeType::$enum()->getValue(), $value);
        }
    }
}