<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\CSRType;

/**
 * Testcase class for CSRType.
 */
class CSRTypeTest extends PHPUnit_Framework_TestCase
{
    public function testCSRType()
    {
        $values = [
            'SELF' => 'self',
            'COMM' => 'comm',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(CSRType::$enum()->value(), $value);
        }
    }
}
