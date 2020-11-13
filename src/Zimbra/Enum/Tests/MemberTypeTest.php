<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\MemberType;

/**
 * Testcase class for MemberType.
 */
class MemberTypeTest extends TestCase
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
            $this->assertSame(MemberType::$enum()->getValue(), $value);
        }
    }
}
