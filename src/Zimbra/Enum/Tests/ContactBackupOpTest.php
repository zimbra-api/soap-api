<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\ContactBackupOp;

/**
 * Testcase class for ContactBackupOp.
 */
class ContactBackupOpTest extends TestCase
{
    public function testContactBackupOp()
    {
        $values = [
            'START'   => 'start',
            'STOP' => 'stop',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(ContactBackupOp::$enum()->getValue(), $value);
        }
    }
}
