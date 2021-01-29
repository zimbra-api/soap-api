<?php

namespace Zimbra\Tests\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\AlarmRelated;

/**
 * Testcase class for AlarmRelated.
 */
class AlarmRelatedTest extends TestCase
{
    public function testAlarmRelated()
    {
        $values = [
            'START' => 'START',
            'END'   => 'END',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(AlarmRelated::$enum()->getValue(), $value);
        }
    }
}
