<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\ZimletStatusSetting;

/**
 * Testcase class for ZimletStatusSetting.
 */
class ZimletStatusSettingTest extends TestCase
{
    public function testZimletStatusSetting()
    {
        $values = [
            'ENABLED'  => 'enabled',
            'DISABLED' => 'disabled',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(ZimletStatusSetting::$enum()->getValue(), $value);
        }
    }
}
