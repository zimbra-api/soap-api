<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\WeekDay;

/**
 * Testcase class for WeekDay.
 */
class WeekDayTest extends TestCase
{
    public function testWeekDay()
    {
        $values = [
            'SUNDAY' => 'SU',
            'MONDAY' => 'MO',
            'TUESDAY' => 'TU',
            'WEDNESDAY' => 'WE',
            'THURSDAY' => 'TH',
            'FRIDAY' => 'FR',
            'SATURDAY' => 'SA',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(WeekDay::$enum()->getValue(), $value);
        }
    }
}
