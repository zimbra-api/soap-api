<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\LockoutOperation;

/**
 * Testcase class for LockoutOperation.
 */
class LockoutOperationTest extends PHPUnit_Framework_TestCase
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
