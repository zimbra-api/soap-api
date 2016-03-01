<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\MemberOfSelector;

/**
 * Testcase class for MemberOfSelector.
 */
class MemberOfSelectorTest extends PHPUnit_Framework_TestCase
{
    public function testMemberOfSelector()
    {
        $values = [
            'ALL'         => 'all',
            'DIRECT_ONLY' => 'directOnly',
            'NONE'        => 'none',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(MemberOfSelector::$enum()->value(), $value);
        }
    }
}
