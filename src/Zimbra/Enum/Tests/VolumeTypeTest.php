<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\VolumeType;

/**
 * Testcase class for VolumeType.
 */
class VolumeTypeTest extends PHPUnit_Framework_TestCase
{
    public function testVolumeType()
    {
        $values = [
        	'PRIMARY'   => 1,
        	'SECONDARY' => 2,
        	'INDEX'     => 10,
    	];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(VolumeType::$enum()->value(), $value);
        }
    }
}
