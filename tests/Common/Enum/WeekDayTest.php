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
        foreach ($values as $name => $value) {
            $this->assertSame(WeekDay::from($value)->value, $value);
            $this->assertSame(WeekDay::from($value)->name, $name);
        }
    }
}
