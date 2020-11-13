<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\AutoProvTaskStatus;

/**
 * Testcase class for AutoProvTaskStatus.
 */
class AutoProvTaskStatusTest extends TestCase
{
    public function testAutoProvTaskStatus()
    {
        $values = [
            'STARTED'  => 'started',
            'RUNNING' => 'running',
            'IDLE'   => 'idle',
            'STOPPED'   => 'stopped',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(AutoProvTaskStatus::$enum()->getValue(), $value);
        }
    }
}
