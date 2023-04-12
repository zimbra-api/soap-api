<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\Type;

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
        foreach ($values as $name => $value) {
            $this->assertSame(Type::from($value)->value, $value);
            $this->assertSame(Type::from($value)->name, $name);
        }
    }
}
