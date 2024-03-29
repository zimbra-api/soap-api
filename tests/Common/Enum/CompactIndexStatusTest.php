<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\CompactIndexStatus;

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
        foreach ($values as $name => $value) {
            $this->assertSame(CompactIndexStatus::from($value)->name, $name);
            $this->assertSame(CompactIndexStatus::from($value)->value, $value);
        }
    }
}
