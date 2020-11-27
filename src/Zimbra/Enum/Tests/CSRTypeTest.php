<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\CSRType;

/**
 * Testcase class for CSRType.
 */
class CSRTypeTest extends TestCase
{
    public function testCSRType()
    {
        $values = [
            'SELF' => 'self',
            'COMM' => 'comm',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(CSRType::$enum()->getValue(), $value);
        }
    }
}
