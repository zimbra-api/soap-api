<?php

namespace Zimbra\Tests\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\MemberOfSelector;

/**
 * Testcase class for MemberOfSelector.
 */
class MemberOfSelectorTest extends TestCase
{
    public function testMemberOfSelector()
    {
        $values = [
            'ALL'         => 'all',
            'DIRECT_ONLY' => 'directOnly',
            'NONE'        => 'none',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(MemberOfSelector::$enum()->getValue(), $value);
        }
    }
}
