<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\CalendarResourceBy;

/**
 * Testcase class for CalendarResourceBy.
 */
class CalendarResourceByTest extends TestCase
{
    public function testCalendarResourceBy()
    {
        $values = [
            'ID'                => 'id',
            'FOREIGN_PRINCIPAL' => 'foreignPrincipal',
            'NAME'              => 'name',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(CalendarResourceBy::$enum()->getValue(), $value);
        }
    }
}
