<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\CompactIndexStatus;

/**
 * Testcase class for CompactIndexStatus.
 */
class CompactIndexStatusTest extends TestCase
{
    public function testCompactIndexStatus()
    {
        $values = [
            'STARTED'  => 'started',
            'RUNNING' => 'running',
            'IDLE' => 'idle',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(CompactIndexStatus::$enum()->getValue(), $value);
        }
    }
}
