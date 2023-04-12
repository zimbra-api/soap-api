<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\MdsConnectionType;

/**
 * Testcase class for MdsConnectionType.
 */
class MdsConnectionTypeTest extends TestCase
{
    public function testMdsConnectionType()
    {
        $values = [
            'CLEAR_TEXT'       => 'cleartext',
            'SSL'              => 'ssl',
            'TLS'              => 'tls',
            'TLS_IS_AVAILABLE' => 'tls_is_available',
        ];
        foreach ($values as $name => $value) {
            $this->assertSame(MdsConnectionType::from($value)->name, $name);
            $this->assertSame(MdsConnectionType::from($value)->value, $value);
        }
    }
}
