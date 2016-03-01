<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\CosBy;

/**
 * Testcase class for CosBy.
 */
class CosByTest extends PHPUnit_Framework_TestCase
{
    public function testCosBy()
    {
        $values = [
            'ID'   => 'id',
            'NAME' => 'name',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(CosBy::$enum()->value(), $value);
        }
    }
}
