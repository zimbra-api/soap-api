<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\RequestFormat;

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
        foreach ($values as $enum => $value) {
            $this->assertSame(RequestFormat::$enum()->getValue(), $value);
        }
    }
}
