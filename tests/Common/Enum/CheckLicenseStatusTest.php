<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\CheckLicenseStatus;

/**
 * Testcase class for CheckLicenseStatus.
 */
class CheckLicenseStatusTest extends TestCase
{
    public function testCheckLicenseStatus()
    {
        $values = [
            'OK' => 'ok',
            'NO' => 'no',
            'IN_GRACE_PERIOD' => 'inGracePeriod',
        ];
        foreach ($values as $name => $value) {
            $this->assertSame(CheckLicenseStatus::from($value)->name, $name);
            $this->assertSame(CheckLicenseStatus::from($value)->value, $value);
        }
    }
}
