<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\GrantGranteeType;

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
        foreach ($values as $name => $value) {
            $this->assertSame(GrantGranteeType::from($value)->name, $name);
            $this->assertSame(GrantGranteeType::from($value)->value, $value);
        }
    }
}
