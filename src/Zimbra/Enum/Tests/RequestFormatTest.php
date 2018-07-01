<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\RequestFormat;

/**
 * Testcase class for RequestFormat.
 */
class RequestFormatTest extends TestCase
{
    public function testRequestFormat()
    {
        $values = [
            'XML' => 'xml',
            'JS'  => 'js',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(RequestFormat::$enum()->value(), $value);
        }
    }
}
