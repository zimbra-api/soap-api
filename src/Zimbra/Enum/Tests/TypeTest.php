<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\Type;

/**
 * Testcase class for Type.
 */
class TypeTest extends PHPUnit_Framework_TestCase
{
    public function testType()
    {
        $values = [
            'USER'   => 'user',
            'SYSTEM' => 'system',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(Type::$enum()->value(), $value);
        }
    }
}
