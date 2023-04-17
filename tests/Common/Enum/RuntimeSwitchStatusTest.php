<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\RuntimeSwitchStatus;

/**
 * Testcase class for RuntimeSwitchStatus.
 */
class RuntimeSwitchStatusTest extends TestCase
{
    public function testRuntimeSwitchStatus()
    {
        $values = [
            'SUCCESS'      => 'SUCCESS',
            'FAIL'         => 'FAIL',
            'NO_OPERATION' => 'NO_OPERATION',
        ];
        foreach ($values as $name => $value) {
            $this->assertSame(RuntimeSwitchStatus::from($value)->name, $name);
            $this->assertSame(RuntimeSwitchStatus::from($value)->value, $value);
        }
    }
}
