<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\Type;

/**
 * Testcase class for Type.
 */
class TypeTest extends TestCase
{
    public function testType()
    {
        $values = [
            'USER'   => 'user',
            'SYSTEM' => 'system',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(Type::$enum()->getValue(), $value);
        }
    }
}
