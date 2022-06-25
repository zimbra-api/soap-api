<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\ContactBackupOp;

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
        foreach ($values as $enum => $value) {
            $this->assertSame(ContactBackupOp::$enum()->getValue(), $value);
        }
    }
}
