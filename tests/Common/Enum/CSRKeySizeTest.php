<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\CSRKeySize;

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
        foreach ($values as $name => $value) {
            $this->assertSame(CSRKeySize::from($value)->name, $name);
            $this->assertSame(CSRKeySize::from($value)->value, $value);
        }
    }
}
