<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\AclType;

/**
 * Testcase class for AclType.
 */
class AclTypeTest extends PHPUnit_Framework_TestCase
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
