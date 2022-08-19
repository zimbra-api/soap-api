<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\ConnectionType;

/**
 * Testcase class for ConnectionType.
 */
class ConnectionTypeTest extends TestCase
{
    public function testConnectionType()
    {
        $values = [
            'CLEAR_TEXT' => 'cleartext',
            'SSL' => 'ssl',
            'TLS' => 'tls',
            'TLS_IF_AVAILABLE' => 'tls_if_available',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(ConnectionType::$enum()->getValue(), $value);
        }
    }
}
