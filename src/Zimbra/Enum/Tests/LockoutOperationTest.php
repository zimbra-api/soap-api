<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\LockoutOperation;

/**
 * Testcase class for LockoutOperation.
 */
class LockoutOperationTest extends TestCase
{
    public function testLockoutOperation()
    {
        $values = [
            'START' => 'start',
            'END'  => 'end',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(LockoutOperation::$enum()->value(), $value);
        }
    }
}
