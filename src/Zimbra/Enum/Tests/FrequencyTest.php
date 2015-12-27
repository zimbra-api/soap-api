<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\Frequency;

/**
 * Testcase class for Frequency.
 */
class FrequencyTest extends PHPUnit_Framework_TestCase
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
        foreach ($values as $enum => $value)
        {
            $this->assertSame(Frequency::$enum()->value(), $value);
        }
    }
}
