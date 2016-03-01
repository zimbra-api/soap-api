<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\SessionType;

/**
 * Testcase class for SessionType.
 */
class SessionTypeTest extends PHPUnit_Framework_TestCase
{
    public function testSessionType()
    {
        $values = [
            'SOAP'  => 'soap',
            'IMAP'  => 'imap',
            'ADMIN' => 'admin',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(SessionType::$enum()->value(), $value);
        }
    }
}
