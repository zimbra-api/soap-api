<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\AceRightType;

/**
 * Testcase class for AceRightType.
 */
class AceRightTypeTest extends TestCase
{
    public function testAceRightType()
    {
        $values = [
            'VIEW_FREE_BUSY' => 'viewFreeBusy',
            'INVITE'         => 'invite',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(AceRightType::$enum()->getValue(), $value);
        }
    }
}
