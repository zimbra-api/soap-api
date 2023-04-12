<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\AutoProvTaskStatus;

/**
 * Testcase class for AutoProvTaskStatus.
 */
class AutoProvTaskStatusTest extends TestCase
{
    public function testAutoProvTaskStatus()
    {
        $values = [
            'STARTED' => 'started',
            'RUNNING' => 'running',
            'IDLE'    => 'idle',
            'STOPPED' => 'stopped',
        ];
        foreach ($values as $name => $value) {
            $this->assertSame(AutoProvTaskStatus::from($value)->name, $name);
            $this->assertSame(AutoProvTaskStatus::from($value)->value, $value);
        }
    }
}
