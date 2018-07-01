<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\AutoProvTaskAction;

/**
 * Testcase class for AutoProvTaskAction.
 */
class AutoProvTaskActionTest extends TestCase
{
    public function testAutoProvTaskAction()
    {
        $values = [
            'START'  => 'start',
            'STATUS' => 'status',
            'STOP'   => 'stop',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(AutoProvTaskAction::$enum()->value(), $value);
        }
    }
}
