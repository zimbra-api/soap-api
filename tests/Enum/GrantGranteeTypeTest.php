<?php

namespace Zimbra\Tests\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\GrantGranteeType;

/**
 * Testcase class for GrantGranteeType.
 */
class GrantGranteeTypeTest extends TestCase
{
    public function testGrantGranteeType()
    {
        $values = [
            'USR'   => 'usr',
            'GRP'   => 'grp',
            'COS'   => 'cos',
            'PUB'   => 'pub',
            'ALL'   => 'all',
            'DOM'   => 'dom',
            'GUEST' => 'guest',
            'KEY'   => 'key',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(GrantGranteeType::$enum()->getValue(), $value);
        }
    }
}
