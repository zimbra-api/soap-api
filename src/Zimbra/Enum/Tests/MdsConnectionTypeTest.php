<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\MdsConnectionType;

/**
 * Testcase class for MdsConnectionType.
 */
class MdsConnectionTypeTest extends PHPUnit_Framework_TestCase
{
    public function testMdsConnectionType()
    {
        $values = [
            'CLEAR_TEXT'       => 'cleartext',
            'SSL'              => 'ssl',
            'TLS'              => 'tls',
            'TLS_IS_AVAILABLE' => 'tls_is_available',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(MdsConnectionType::$enum()->value(), $value);
        }
    }
}
