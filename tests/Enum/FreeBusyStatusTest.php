<?php

namespace Zimbra\Tests\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\FreeBusyStatus;

/**
 * Testcase class for FreeBusyStatus.
 */
class FreeBusyStatusTest extends TestCase
{
    public function testFreeBusyStatus()
    {
         $values = [
            'FREE'          => 'F',
            'BUSY'          => 'B',
            'TENTATIVE'     => 'T',
            'OUT_OF_OFFICE' => 'U',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(FreeBusyStatus::$enum()->getValue(), $value);
        }
    }
}
