<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\TargetBy;

/**
 * Testcase class for TargetBy.
 */
class TargetByTest extends PHPUnit_Framework_TestCase
{
    public function testTargetBy()
    {
        $values = [
            'ID'   => 'id',
            'NAME' => 'name',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(TargetBy::$enum()->value(), $value);
        }
    }
}
