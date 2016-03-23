<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\AlwaysOnClusterBy;

/**
 * Testcase class for AlwaysOnClusterBy.
 */
class AlwaysOnClusterByTest extends PHPUnit_Framework_TestCase
{
    public function testAlwaysOnClusterBy()
    {
        $values = [
            'ID'   => 'id',
            'NAME' => 'name',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(AlwaysOnClusterBy::$enum()->value(), $value);
        }
    }
}
