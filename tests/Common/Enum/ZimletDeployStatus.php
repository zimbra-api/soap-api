<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\ZimletDeployStatus;

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
        foreach ($values as $name => $value) {
            $this->assertSame(ZimletDeployStatus::from($value)->value, $value);
            $this->assertSame(ZimletDeployStatus::from($value)->name, $name);
        }
    }
}
