<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\ZimletStatus;

/**
 * Testcase class for ZimletStatus.
 */
class ZimletStatusTest extends PHPUnit_Framework_TestCase
{
    public function testZimletStatus()
    {
        $values = [
            'ENABLED'  => 'enabled',
            'DISABLED' => 'disabled',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(ZimletStatus::$enum()->value(), $value);
        }
    }
}
