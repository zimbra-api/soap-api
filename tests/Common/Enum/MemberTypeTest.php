<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\MemberType;

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
        foreach ($values as $name => $value) {
            $this->assertSame(MemberType::from($value)->name, $name);
            $this->assertSame(MemberType::from($value)->value, $value);
        }
    }
}
