<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\CSRKeySize;

/**
 * Testcase class for CSRKeySize.
 */
class CSRKeySizeTest extends TestCase
{
    public function testCSRKeySize()
    {
        $values = [
            'SIZE_1024' => 1024,
            'SIZE_2048' => 2048,
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(CSRKeySize::$enum()->value(), $value);
        }
    }
}
