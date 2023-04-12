<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\AceRightType;

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
        foreach ($values as $name => $value) {
            $this->assertSame(AceRightType::from($value)->name, $name);
            $this->assertSame(AceRightType::from($value)->value, $value);
        }
    }
}
