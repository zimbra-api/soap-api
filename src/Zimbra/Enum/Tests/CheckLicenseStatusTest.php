<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\CheckLicenseStatus;

/**
 * Testcase class for CheckLicenseStatus.
 */
class CheckLicenseStatusTest extends TestCase
{
    public function testCheckLicenseStatus()
    {
        $values = [
            'OK' => 'ok',
            'NO'  => 'no',
            'IN_GRACE_PERIOD'  => 'inGracePeriod',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(CheckLicenseStatus::$enum()->getValue(), $value);
        }
    }
}
