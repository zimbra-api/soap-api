<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\TargetBy;

/**
 * Testcase class for TargetBy.
 */
class TargetByTest extends TestCase
{
    public function testTargetBy()
    {
        $values = [
            'ID'   => 'id',
            'NAME' => 'name',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(TargetBy::$enum()->getValue(), $value);
        }
    }
}
