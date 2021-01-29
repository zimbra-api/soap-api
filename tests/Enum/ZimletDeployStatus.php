<?php

namespace Zimbra\Tests\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\ZimletDeployStatus;

/**
 * Testcase class for ZimletDeployStatus.
 */
class ZimletDeployStatusTest extends TestCase
{
    public function testZimletDeployStatus()
    {
        $values = [
            'SUCCEEDED'  => 'succeeded',
            'FAILED' => 'failed',
            'PENDING' => 'pending',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(ZimletDeployStatus::$enum()->getValue(), $value);
        }
    }
}
