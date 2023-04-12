<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\AlarmRelated;

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
        foreach ($values as $name => $value) {
            $this->assertSame(AlarmRelated::from($value)->name, $name);
            $this->assertSame(AlarmRelated::from($value)->value, $value);
        }
    }
}
