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
        foreach ($values as $name => $value) {
            $this->assertSame(RequestFormat::from($value)->name, $name);
            $this->assertSame(RequestFormat::from($value)->value, $value);
        }
    }
}
