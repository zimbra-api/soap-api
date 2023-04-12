<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\ContactBackupStatus;

/**
 * Testcase class for ContactBackupStatus.
 */
class ContactBackupStatusTest extends TestCase
{
    public function testContactBackupStatus()
    {
        $values = [
            'STARTED' => 'started',
            'ERROR'   => 'error',
            'STOPPED' => 'stopped',
        ];
        foreach ($values as $name => $value) {
            $this->assertSame(ContactBackupStatus::from($value)->name, $name);
            $this->assertSame(ContactBackupStatus::from($value)->value, $value);
        }
    }
}
