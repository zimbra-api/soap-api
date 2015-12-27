<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\CalendarResourceBy;

/**
 * Testcase class for CalendarResourceBy.
 */
class CalendarResourceByTest extends PHPUnit_Framework_TestCase
{
    public function testCalendarResourceBy()
    {
        $values = [
            'ID'                => 'id',
            'FOREIGN_PRINCIPAL' => 'foreignPrincipal',
            'NAME'              => 'name',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(CalendarResourceBy::$enum()->value(), $value);
        }
    }
}
