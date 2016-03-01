<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\AlarmAction;

/**
 * Testcase class for AlarmAction.
 */
class AlarmActionTest extends PHPUnit_Framework_TestCase
{
    public function testAlarmAction()
    {
        $values = [
            'DISPLAY'      => 'DISPLAY',
            'AUDIO'        => 'AUDIO',
            'EMAIL'        => 'EMAIL',
            'PROCEDURE'    => 'PROCEDURE',
            'YAHOO_IM'     => 'X_YAHOO_CALENDAR_ACTION_IM',
            'YAHOO_MOBILE' => 'X_YAHOO_CALENDAR_ACTION_MOBILE',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(AlarmAction::$enum()->value(), $value);
        }
    }
}
