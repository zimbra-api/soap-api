<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\AceRightType;

/**
 * Testcase class for AceRightType.
 */
class AceRightTypeTest extends PHPUnit_Framework_TestCase
{
    public function testAceRightType()
    {
        $values = [
            'VIEW_FREE_BUSY' => 'viewFreeBusy',
            'INVITE'         => 'invite',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(AceRightType::$enum()->value(), $value);
        }
    }
}
