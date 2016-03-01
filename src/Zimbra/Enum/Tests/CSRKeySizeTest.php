<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\CSRKeySize;

/**
 * Testcase class for CSRKeySize.
 */
class CSRKeySizeTest extends PHPUnit_Framework_TestCase
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
