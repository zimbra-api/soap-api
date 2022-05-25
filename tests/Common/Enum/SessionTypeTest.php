<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\SessionType;

/**
 * Testcase class for SessionType.
 */
class SessionTypeTest extends TestCase
{
    public function testSessionType()
    {
        $values = [
            'SOAP'  => 'soap',
            'IMAP'  => 'imap',
            'ADMIN' => 'admin',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(SessionType::$enum()->getValue(), $value);
        }
    }
}
