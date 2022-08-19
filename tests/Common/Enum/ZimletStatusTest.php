<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\ZimletStatus;

/**
 * Testcase class for ZimletStatus.
 */
class ZimletStatusTest extends TestCase
{
    public function testZimletStatus()
    {
        $values = [
            'ENABLED'  => 'enabled',
            'DISABLED' => 'disabled',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(ZimletStatus::$enum()->getValue(), $value);
        }
    }
}
