<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\VolumeType;

/**
 * Testcase class for VolumeType.
 */
class VolumeTypeTest extends TestCase
{
    public function testVolumeType()
    {
        $values = [
        	'PRIMARY'   => 1,
        	'SECONDARY' => 2,
        	'INDEX'     => 10,
    	];
        foreach ($values as $enum => $value) {
            $this->assertSame(VolumeType::$enum()->getValue(), $value);
        }
    }
}
