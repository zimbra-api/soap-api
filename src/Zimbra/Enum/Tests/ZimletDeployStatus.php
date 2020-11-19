<?php

namespace Zimbra\Enum\Tests;

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
        foreach ($values as $enum => $value)
        {
            $this->assertSame(ZimletDeployStatus::$enum()->getValue(), $value);
        }
    }
}
