<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\AclType;

/**
 * Testcase class for AclType.
 */
class AclTypeTest extends TestCase
{
    public function testAclType()
    {
        $values = [
            'GRANT' => 'grant',
            'DENY'  => 'deny',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(AclType::$enum()->value(), $value);
        }
    }
}
