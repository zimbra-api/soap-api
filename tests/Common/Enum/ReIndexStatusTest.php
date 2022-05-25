<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\ReIndexStatus;

/**
 * Testcase class for ReIndexStatus.
 */
class ReIndexStatusTest extends TestCase
{
    public function testReIndexStatus()
    {
        $values = [
            'STARTED'  => 'started',
            'RUNNING' => 'running',
            'CANCELLED' => 'cancelled',
            'IDLE' => 'idle',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(ReIndexStatus::$enum()->getValue(), $value);
        }
    }
}
