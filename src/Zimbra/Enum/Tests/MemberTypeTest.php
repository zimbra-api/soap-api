<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\MemberType;

/**
 * Testcase class for MemberType.
 */
class MemberTypeTest extends PHPUnit_Framework_TestCase
{
    public function testMemberType()
    {
        $values = [
            'CONTACT'        => 'C',
            'GAL_ENTRY'      => 'G',
            'INLINED_MEMBER' => 'I',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(MemberType::$enum()->value(), $value);
        }
    }
}
