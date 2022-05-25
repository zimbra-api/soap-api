<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\Frequency;

/**
 * Testcase class for Frequency.
 */
class FrequencyTest extends TestCase
{
    public function testFrequency()
    {
        $values = [
            'SECOND' => 'SEC',
            'MINUTE' => 'MIN',
            'HOUR'   => 'HOU',
            'DAY'    => 'DAI',
            'WEEK'   => 'WEE',
            'MONTH'  => 'MON',
            'YEAR'   => 'YEA',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(Frequency::$enum()->getValue(), $value);
        }
    }
}
