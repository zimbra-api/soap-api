<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\MemberOfSelector;

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
        foreach ($values as $name => $value) {
            $this->assertSame(MemberOfSelector::from($value)->name, $name);
            $this->assertSame(MemberOfSelector::from($value)->value, $value);
        }
    }
}
