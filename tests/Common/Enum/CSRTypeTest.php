<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\CSRType;

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
