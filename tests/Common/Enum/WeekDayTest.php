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
            'SU' => 'SU',
            'MO' => 'MO',
            'TU' => 'TU',
            'WE' => 'WE',
            'TH' => 'TH',
            'FR' => 'FR',
            'SA' => 'SA',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(WeekDay::$enum()->getValue(), $value);
        }
    }
}
